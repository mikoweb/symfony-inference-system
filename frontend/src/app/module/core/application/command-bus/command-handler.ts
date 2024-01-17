import Command from './command';

export default interface CommandHandler<T extends Command> {
  commandType: string;
  execute: (command: T) => Promise<any>;
}
