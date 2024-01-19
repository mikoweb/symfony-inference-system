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
import {
  LanguageUserExperienceFilterComponent
} from '@app/module/language-choice/application/elements/language-user-experience-filter/language-user-experience-filter.component';
import UserExperienceFilterItem from '@app/module/language-choice/domain/filter/user-experience-filter-item';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: LanguageChoiceFormComponent.customElementName,
  templateUrl: './language-choice-form.component.html',
  styleUrls: ['./language-choice-form.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, ReactiveFormsModule, NgForOf, TranslateModule, LanguageUserExperienceFilterComponent],
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
    popularityForecastYear: new FormControl(),
    userExperienceFilterItemList: new FormControl(),
  });

  protected readonly formPackage = new FormGroup({
    package: new FormControl(),
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
    this.clearPackage();
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
    await this.submit();
  }

  protected async submit(): Promise<void> {
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

  protected clearPackage(): void {
    this.formPackage.get('package')?.setValue(null);
  }

  protected getPackageOptionValue(name: string): object | null {
    return this.options?.getFilterPackages()?.get(name) ?? null;
  }

  protected getPackageNames(): string[] {
    const names: string[] = [];

    for (const name of this.options?.getFilterPackages()?.keys() ?? []) {
      names.push(name);
    }

    return names;
  }

  protected async onPackageChange(event: any): Promise<void> {
    const formData = event.detail.value;
    this.clearPackage();

    if (formData !== null) {
      this.setFormData(formData);
      await this.submit();
    }
  }

  protected setFormData(formData: any): void {
    this.form.get('usage')?.setValue(formData.usage ?? null);
    this.form.get('usageMode')?.setValue(formData.usageMode ?? 'and');
    this.form.get('features')?.setValue(formData.features ?? null);
    this.form.get('featuresMode')?.setValue(formData.usageMode ?? 'and');
    this.form.get('minimumPerformanceLevel')?.setValue(formData.minimumPerformanceLevel ?? null);
    this.form.get('minimumPopularityLevel')?.setValue(formData.minimumPopularityLevel ?? null);
  }

  protected onUserExperienceUpdated(items: UserExperienceFilterItem[]): void {
    this.form.get('userExperienceFilterItemList')?.setValue(items.length > 0 ? items : null);
  }
}
