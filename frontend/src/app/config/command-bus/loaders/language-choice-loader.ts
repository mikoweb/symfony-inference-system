import { inject } from '@angular/core';
import CommandHandlerRegistry from '@app/module/core/application/command-bus/command-handler-registry';
import SubmitLanguageChoiceFormHandler
  from '@app/module/language-choice/application/command-handler/submit-language-choice-form-handler';

export default function languageChoiceLoader() {
  inject(CommandHandlerRegistry).registerAny([
    inject(SubmitLanguageChoiceFormHandler),
  ]);
}
