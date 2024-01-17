import * as $ from 'jquery';
import BehaviorEvent from './value-object/behavior-event';

export default abstract class Behavior {
  protected readonly $element: any;

  constructor(
    protected readonly element: Element,
  ) {
    this.$element = $(element);
    this.initEvents();
  }

  protected abstract get events(): BehaviorEvent[];

  private initEvents(): void {
    for (const event of this.events) {
      if (event.selector == null) {
        this.$element.on(event.events, event.handler);
      } else {
        this.$element.on(event.events, event.selector, event.handler);
      }
    }
  }
}
