import { LayoutReady } from './layout-ready';
import { AppProgressBehavior } from './behavior/app-progress-behavior';
import { IonProgressBar } from '@ionic/angular/directives/proxies';
import { DrawerToggleBehavior } from './behavior/drawer-toggle-behavior';

export class LayoutInitializer {
  public static init(): void {
    LayoutReady.onReady(() => {
      this.initAppProgress();
      this.initElementsReady();
      this.initDrawerToggle();
    });
  }

  private static initAppProgress(): void {
    const progress = document.querySelector('#app-progress');

    if (progress) {
      new AppProgressBehavior(progress as HTMLElement & IonProgressBar);
    }
  }

  private static initElementsReady(): void {
    for (const el of document.querySelectorAll('*[wc-hidden], *[wc-lazy], *[wc-ready]')) {
      el.classList.add('ready');
    }
  }

  private static initDrawerToggle(): void {
    for (const el of document.querySelectorAll('.app-drawer-toggle')) {
      new DrawerToggleBehavior(el);
    }
  }
}
