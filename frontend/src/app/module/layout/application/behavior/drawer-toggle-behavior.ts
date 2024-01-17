import { Drawer } from '@material/mwc-drawer';
import Behavior from '@app/module/core/application/behavior/behavior';
import BehaviorEvent from '@app/module/core/application/behavior/value-object/behavior-event';

export class DrawerToggleBehavior extends Behavior {
  protected get events(): BehaviorEvent[] {
    return [
      new BehaviorEvent('click', (event: Event) => this.onClick(event)),
    ];
  }

  private onClick(event: Event): void {
    const element = this.element;

    if (element.hasAttribute('data-drawer-id')) {
      const id = element.getAttribute('data-drawer-id') as string;

      if (id.length > 0) {
        const drawer = document.getElementById(id) as Drawer;

        if (drawer !== null) {
          drawer.open = !drawer.open;
        }
      }
    }
  }
}
