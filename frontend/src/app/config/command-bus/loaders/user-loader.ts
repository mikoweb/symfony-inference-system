import { inject } from '@angular/core';
import CommandHandlerRegistry from '@app/module/core/application/command-bus/command-handler-registry';
import SaveUserDataHandler from '@app/module/user/application/command-handler/save-user-data-handler';
import LoadUserDataHandler from '@app/module/user/application/command-handler/load-user-data-handler';

export default function userLoader() {
  inject(CommandHandlerRegistry).registerAny([
    inject(SaveUserDataHandler),
    inject(LoadUserDataHandler),
  ]);
}
