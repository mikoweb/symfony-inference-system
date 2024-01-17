import { Component, ElementRef, OnInit } from '@angular/core';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';
import LanguageFilterOptionsDto from '@app/module/language-choice/domain/dto/language-filter-options-dto';
import GetLanguageFilterOptionsQuery
  from '@app/module/language-choice/infrastructure/query/get-language-filter-options-query';
import { IonicModule } from '@ionic/angular';
import { ReactiveFormsModule } from '@angular/forms';
import { NgForOf } from '@angular/common';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: LanguageChoiceFormComponent.customElementName,
  templateUrl: './language-choice-form.component.html',
  styleUrls: ['./language-choice-form.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, ReactiveFormsModule, NgForOf],
})
@CustomElement()
export class LanguageChoiceFormComponent extends CustomElementBaseComponent implements OnInit {
  public static override readonly customElementName: string = 'app-language-choice-form';

  protected options?: LanguageFilterOptionsDto;

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    private readonly optionsQuery: GetLanguageFilterOptionsQuery
  ) {
    super(ele, gsl);
  }

  protected override get useGlobalStyle(): boolean {
    return true;
  }

  async ngOnInit(): Promise<void> {
    this.options = await this.optionsQuery.getOptions();
  }
}
