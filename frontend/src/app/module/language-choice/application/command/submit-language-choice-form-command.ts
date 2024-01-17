import Command from '@app/module/core/application/command-bus/command';

export default class SubmitLanguageChoiceFormCommand extends Command {
  constructor(
    public readonly formData: any,
  ) {
    super();
  }
}
