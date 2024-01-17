import { Component, ElementRef, OnInit } from '@angular/core';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';
import LanguageFilterOptionsDto from '@app/module/language-choice/domain/dto/language-filter-options-dto';
import GetLanguageFilterOptionsQuery
  from '@app/module/language-choice/infrastructure/query/get-language-filter-options-query';
import { IonicModule } from '@ionic/angular';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { NgForOf } from '@angular/common';
import CommandBus from '@app/module/core/application/command-bus/command-bus';
import SubmitLanguageChoiceFormCommand
  from '@app/module/language-choice/application/command/submit-language-choice-form-command';
import { TranslateModule } from '@ngx-translate/core';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: LanguageChoiceFormComponent.customElementName,
  templateUrl: './language-choice-form.component.html',
  styleUrls: ['./language-choice-form.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, ReactiveFormsModule, NgForOf, TranslateModule],
})
@CustomElement()
export class LanguageChoiceFormComponent extends CustomElementBaseComponent implements OnInit {
  public static override readonly customElementName: string = 'app-language-choice-form';

  protected options?: LanguageFilterOptionsDto;
  protected formDisabled: boolean = false;

  protected readonly form = new FormGroup({
    usage: new FormControl(),
    usageMode: new FormControl(),
    features: new FormControl(),
    featuresMode: new FormControl(),
    minimumPerformanceLevel: new FormControl(),
    minimumPopularityLevel: new FormControl(),
  });

  private readonly nullableProperties: string[] = [
    'usage',
    'features',
    'minimumPerformanceLevel',
    'minimumPopularityLevel'
  ];

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    private readonly optionsQuery: GetLanguageFilterOptionsQuery,
    private readonly commandBus: CommandBus
  ) {
    super(ele, gsl);
  }

  protected override get useGlobalStyle(): boolean {
    return true;
  }

  async ngOnInit(): Promise<void> {
    this.form.get('usageMode')?.setValue('and');
    this.form.get('featuresMode')?.setValue('and');
    this.options = await this.optionsQuery.getOptions();
  }

  public isFilled(): boolean {
    for (const property of this.nullableProperties) {
      const value = this.form.get(property)?.value;

      if (value !== null) {
        return true;
      }
    }

    return false;
  }

  protected async onSubmit(): Promise<void> {
    if (this.isFilled()) {
      this.formDisabled = true;
      await this.commandBus.execute(new SubmitLanguageChoiceFormCommand(this.form.value));
      this.formDisabled = false;
    }
  }

  protected clearEmptyValue(event: any, propertyName: string): void {
    const value = event.detail.value;

    if (Array.isArray(value) && value.length === 0) {
      this.form.get(propertyName)?.setValue(null);
    }
  }
}
