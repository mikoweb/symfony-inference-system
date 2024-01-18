import { Component } from '@angular/core';
import {
  LanguageChoiceFormComponent
} from '@app/module/language-choice/application/elements/language-choice-form/language-choice-form.component';
import { TranslateModule } from '@ngx-translate/core';
import {
  LanguageInferenceResultsComponent
} from '@app/module/language-choice/application/elements/language-inference-results/language-inference-results.component';

@Component({
  selector: 'app-default-page',
  templateUrl: './default-page.component.html',
  styleUrls: ['./default-page.component.scss'],
  imports: [
    LanguageChoiceFormComponent,
    TranslateModule,
    LanguageInferenceResultsComponent,
  ],
  standalone: true
})
export class DefaultPageComponent {
}
