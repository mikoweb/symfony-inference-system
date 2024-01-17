import { Injectable } from '@angular/core';
import CommandHandler from './command-handler';

@Injectable({
  providedIn: 'root',
})
export default class CommandHandlerRegistry {
  private handlers: CommandHandler<any>[] = [];

  public register(handler: CommandHandler<any>): void {
    this.handlers.push(handler);
  }

  public registerAny(handlers: CommandHandler<any>[]): void {
    for (const handler of handlers) {
      this.register(handler);
    }
  }

  public getHandlers(): CommandHandler<any>[] {
    return this.handlers;
  }
}
