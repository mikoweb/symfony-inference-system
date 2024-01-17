import { LayoutReady } from './layout-ready';
import { AppProgressBehavior } from './behavior/app-progress-behavior';
import { IonProgressBar } from '@ionic/angular/directives/proxies';

export class LayoutInitializer {
  public static init(): void {
    LayoutReady.onReady(() => {
      this.initAppProgress();
      this.initElementsReady();
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
}
