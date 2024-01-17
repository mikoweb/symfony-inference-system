import { Injectable } from '@angular/core';
import CommandHandler from '@app/module/core/application/command-bus/command-handler';
import LoadUserDataCommand from '@app/module/user/application/command/load-user-data-command';
import LoadUserDataQuery from '@app/module/user/infrastructure/query/load-user-data-query';
import UserDataStore from '@app/module/user/infrastructure/store/user-data-store';

@Injectable({
  providedIn: 'root',
})
export default class LoadUserDataHandler implements CommandHandler<LoadUserDataCommand> {
  public readonly commandType: string = LoadUserDataCommand.commandName;

  constructor(
    private readonly loadUserDataQuery: LoadUserDataQuery,
    private readonly userDataStore: UserDataStore,
  ) {}

  public async execute(command: LoadUserDataCommand) {
    const userData = this.loadUserDataQuery.load();

    this.userDataStore.loadFromDTO(userData);
  }
}
