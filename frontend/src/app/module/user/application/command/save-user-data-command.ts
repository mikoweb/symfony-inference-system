import Command from '@app/module/core/application/command-bus/command';
import UserDataDTO from '@app/module/user/domain/dto/user-data-dto';

export default class SaveUserDataCommand extends Command {
  constructor(
    public readonly userDataDTO: UserDataDTO
  ) {
    super();
  }
}
