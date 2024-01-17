export default class BehaviorEvent {
  constructor(
    public readonly events: string,
    public readonly handler: Function,
    public readonly selector?: string,
  ) {}
}
