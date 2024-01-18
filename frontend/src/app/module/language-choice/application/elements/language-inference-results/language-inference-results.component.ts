import { ChangeDetectionStrategy, Component, ElementRef } from '@angular/core';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import { IonicModule } from '@ionic/angular';
import { MobxAngularModule } from 'mobx-angular';
import LanguageInferenceResultsStore from '@app/module/language-choice/application/store/LanguageInferenceResultsStore';
import { DecimalPipe, NgForOf, NgIf } from '@angular/common';
import { TranslateModule } from '@ngx-translate/core';
import { TinyColor } from '@ctrl/tinycolor';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: LanguageInferenceResultsComponent.customElementName,
  templateUrl: './language-inference-results.component.html',
  styleUrls: ['./language-inference-results.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
  standalone: true,
  encapsulation,
  schemas,
  imports: [IonicModule, MobxAngularModule, NgIf, NgForOf, TranslateModule, DecimalPipe],
})
@CustomElement()
export class LanguageInferenceResultsComponent extends CustomElementBaseComponent {
  public static override readonly customElementName: string = 'app-language-inference-results';

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    protected readonly store: LanguageInferenceResultsStore
  ) {
    super(ele, gsl);
  }

  protected override get useGlobalStyle(): boolean {
    return true;
  }

  protected getScoreStyle(score: number): string {
    return `background: ${this.getScoreBackground(score)}; color: ${this.getScoreColor(score)};`;
  }

  protected getScoreColor(score: number): string {
    if (score > 0.7) {
      return '#fff';
    } else if (score > 0.12) {
      return '#000';
    } else {
      return '#fff';
    }
  }

  protected getScoreBackground(score: number): string {
    let color: TinyColor;

    if (score > 0.5) {
      color = new TinyColor('#388e3c').lighten((1 - score) * 100);
    } else if (score > 0.35) {
      color = new TinyColor('#c0ca33').lighten((1 - (score * 1.5)) * 100);
    } else {
      color = new TinyColor('#d50000').lighten(score * 3 * 100);
    }

    return color.toHexString();
  }
}
