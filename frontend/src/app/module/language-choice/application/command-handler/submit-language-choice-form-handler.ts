import { Injectable } from '@angular/core';
import CommandHandler from '@app/module/core/application/command-bus/command-handler';
import SubmitLanguageChoiceFormCommand
  from '@app/module/language-choice/application/command/submit-language-choice-form-command';
import LanguageChoiceSender from '@app/module/language-choice/infrastructure/send/language-choice-sender';
import LanguageInferenceResultsStore from '@app/module/language-choice/application/store/LanguageInferenceResultsStore';

@Injectable({
  providedIn: 'root',
})
export default class SubmitLanguageChoiceFormHandler implements CommandHandler<SubmitLanguageChoiceFormCommand> {
  public readonly commandType: string = SubmitLanguageChoiceFormCommand.commandName;

  constructor(
    private readonly languageChoiceSender: LanguageChoiceSender,
    private readonly languageInferenceResultsStore: LanguageInferenceResultsStore
  ) {}

  public async execute(command: SubmitLanguageChoiceFormCommand): Promise<void> {
    this.languageInferenceResultsStore.results = await this.languageChoiceSender.send(command.formData);
  }
}
