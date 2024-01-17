import { Component } from '@angular/core';
import {
  LanguageChoiceFormComponent
} from '@app/module/language-choice/application/elements/language-choice-form/language-choice-form.component';

@Component({
  selector: 'app-default-page',
  templateUrl: './default-page.component.html',
  styleUrls: ['./default-page.component.scss'],
  imports: [
    LanguageChoiceFormComponent
  ],
  standalone: true
})
export class DefaultPageComponent {
}
