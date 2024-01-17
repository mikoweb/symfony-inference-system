import { Command as BaseCommand } from '@tshio/command-bus';
import { v4 as uuidv4 } from 'uuid';

export default abstract class Command implements BaseCommand<string> {
  public payload: string = '';
  protected static commandId?: string;

  public static get commandName(): string
  {
    if (!this.commandId) {
      this.commandId = this.name + '_' + uuidv4();
    }

    return this.commandId;
  }

  public get type(): string {
    const constructor: any = this.constructor;

    return constructor.commandName;
  }
}
