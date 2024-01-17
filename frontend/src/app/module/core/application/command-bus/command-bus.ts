import { CommandBus as BaseCommandBus } from '@tshio/command-bus';
import { Injectable } from '@angular/core';
import CommandHandlerRegistry from './command-handler-registry';

@Injectable({
  providedIn: 'root',
})
export default class CommandBus extends BaseCommandBus {
  constructor(commandHandlerRegistry: CommandHandlerRegistry) {
    super(commandHandlerRegistry.getHandlers());
  }
}
