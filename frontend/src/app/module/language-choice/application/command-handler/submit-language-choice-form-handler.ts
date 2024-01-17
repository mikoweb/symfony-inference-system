import { Injectable } from '@angular/core';
import CommandHandler from '@app/module/core/application/command-bus/command-handler';
import SubmitLanguageChoiceFormCommand
  from '@app/module/language-choice/application/command/submit-language-choice-form-command';
import LanguageChoiceSender from '@app/module/language-choice/infrastructure/send/language-choice-sender';
import LanguageInferenceResultDto from '@app/module/language-choice/domain/dto/language-inference-result-dto';

@Injectable({
  providedIn: 'root',
})
export default class SubmitLanguageChoiceFormHandler implements CommandHandler<SubmitLanguageChoiceFormCommand> {
  public readonly commandType: string = SubmitLanguageChoiceFormCommand.commandName;

  constructor(
    private readonly languageChoiceSender: LanguageChoiceSender
  ) {}

  public async execute(command: SubmitLanguageChoiceFormCommand): Promise<void> {
    const results: LanguageInferenceResultDto[] = await this.languageChoiceSender.send(command.formData);

    console.log(results);
  }
}
