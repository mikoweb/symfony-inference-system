import { ChangeDetectionStrategy, Component, ElementRef, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { FormGroup, FormControl,ReactiveFormsModule } from '@angular/forms';
import UserDataStore from '@app/module/user/infrastructure/store/user-data-store';
import { autorun } from 'mobx';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import CommandBus from '@app/module/core/application/command-bus/command-bus';
import SaveUserDataCommand from '@app/module/user/application/command/save-user-data-command';
import UserDataDTO from '@app/module/user/domain/dto/user-data-dto';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: UserDataFormComponent.customElementName,
  templateUrl: './user-data-form.component.html',
  styleUrls: ['./user-data-form.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, ReactiveFormsModule]
})
@CustomElement()
export class UserDataFormComponent extends CustomElementBaseComponent implements OnInit {
  public static override readonly customElementName: string = 'app-user-data-form';

  protected readonly form = new FormGroup({
    firstName: new FormControl(),
    lastName: new FormControl(),
    email: new FormControl(),
  });

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    protected readonly userDataStore: UserDataStore,
    private readonly commandBus: CommandBus
  ) {
    super(ele, gsl);
  }

  protected override get useGlobalStyle(): boolean {
    return true;
  }

  public ngOnInit(): void {
    autorun(() => this.updateFormFromStore());
  }

  protected onSubmit(): void {
    if (this.form.valid) {
      this.commandBus.execute(new SaveUserDataCommand(
        UserDataDTO.createFromObject(this.form.value)
      ));
    }
  }

  private updateFormFromStore(): void
  {
    const store = this.userDataStore;

    this.form.setValue({
      firstName: store.firstName ?? '',
      lastName: store.lastName ?? '',
      email: store.email ?? '',
    });
  }
}
