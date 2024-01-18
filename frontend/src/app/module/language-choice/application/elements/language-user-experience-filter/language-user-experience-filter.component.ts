import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';
import { IonicModule, IonModal } from '@ionic/angular';
import { NgForOf } from '@angular/common';
import UserExperienceFilterItem from '@app/module/language-choice/domain/filter/user-experience-filter-item';
import SelectOptionDto from '@app/module/language-choice/domain/dto/select-option-dto';
import { UserExperienceLevelEnum } from '@app/module/language-choice/domain/fuzzy/user-experience-level-enum';
import _ from 'lodash';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { TranslateModule } from '@ngx-translate/core';
import GetLanguagesQuery from '@app/module/language/infrastructure/query/get-languages-query';
import LanguageData from '@app/module/language/domain/language-data';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: LanguageUserExperienceFilterComponent.customElementName,
  templateUrl: './language-user-experience-filter.component.html',
  styleUrls: ['./language-user-experience-filter.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, NgForOf, ReactiveFormsModule, TranslateModule],
})
@CustomElement()
export class LanguageUserExperienceFilterComponent extends CustomElementBaseComponent implements OnInit {
  public static override readonly customElementName: string = 'app-language-user-experience-filter';

  protected languages?: LanguageData[] | null;
  protected items: UserExperienceFilterItem[] = [];

  @Input() userExperienceLevelOptions: SelectOptionDto[] = [];
  @Output() itemsUpdatedEvent = new EventEmitter<UserExperienceFilterItem[]>();

  @ViewChild(IonModal) modal?: IonModal;

  protected readonly form = new FormGroup({
    langId: new FormControl(),
    levelKey: new FormControl(),
  });

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    private readonly getLanguagesQuery: GetLanguagesQuery
  ) {
    super(ele, gsl);
  }

  protected override get useGlobalStyle(): boolean {
    return true;
  }

  async ngOnInit(): Promise<void> {
    this.languages = await this.getLanguagesQuery.getLanguages();
  }

  protected onAddClick(): void {
    this.modal?.present();
  }

  protected onDeleteClick(item: UserExperienceFilterItem): void {
    this.deleteItem(item);
  }

  protected onModalCancel(): void {
    this.modal?.dismiss(null, 'cancel');
  }

  protected onSubmitForm(): void {
    this.modal?.dismiss(null, 'confirm');
    this.submitForm();
  }

  private submitForm() {
    if (this.form.valid) {
      this.addItem(this.form.get('langId')?.value, this.form.get('levelKey')?.value);
      this.form.reset();
    }
  }

  private deleteItem(item: UserExperienceFilterItem): void {
    const index = this.items.indexOf(item);
    this.items.splice(index, 1);

    this.emitItems();
  }

  private addItem(langId: string, levelKey: number): void {
    const levelResult = this.userExperienceLevelOptions.filter(
      (option) => option.value === levelKey
    ) ?? [];

    const languageResult = this.languages?.filter(
      (language) => language.id === langId
    ) ?? [];

    const level = levelResult.length > 0 ? levelResult[0] : null;
    const language = languageResult.length > 0 ? languageResult[0] : null;

    this.items.push(new UserExperienceFilterItem(
      langId,
      language?.name ?? '',
      _.snakeCase(UserExperienceLevelEnum[(level?.value ?? 0) as number].toString()).toUpperCase(),
      level?.label ?? '',
    ));

    this.emitItems();
  }

  private emitItems(): void {
    this.itemsUpdatedEvent.emit(this.items);
  }
}
