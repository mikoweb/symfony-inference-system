import { IonProgressBar } from '@ionic/angular/directives/proxies';
import { LayoutReady } from '../layout-ready';

export class AppProgressBehavior {
  private loaded: boolean = false;
  private docReady: boolean = false;
  private layoutReady: boolean = false;

  constructor(
    private readonly progressBar: Element & IonProgressBar,
    private readonly defaultProgress: number = 0
  ) {
    this.init();
  }

  private init(): void {
    this.progressBar.classList.add('active');
    this.reset();

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => {
        this.actionAfterDomReady();
      });
    } else {
      this.actionAfterDomReady();
    }

    LayoutReady.onReady(() => {
      this.layoutReady = true;
      this.loadUpdate();
    });

    window.addEventListener('beforeunload', () => {
      this.progressBar.classList.add('active');
      this.reset();
    });
  }

  private reset(): void {
    this.loaded = false;
    this.docReady = false;
    this.layoutReady = false;
    this.progressBar.value = this.defaultProgress;
  }

  private actionAfterDomReady() {
    this.docReady = true;
    this.loadUpdate();
  }

  private loadUpdate() {
    if (this.docReady && this.layoutReady) {
      setTimeout(() => {
        this.progressBar.value = 1;
      }, 100);

      setTimeout(() => {
        this.progressBar.classList.remove('active');
      }, 1000);

      this.loaded = true;
    } else if (this.docReady || this.layoutReady) {
      setTimeout(() => {
        this.progressBar.value = 0.4;
      }, 100);
    } else {
      setTimeout(() => {
        this.progressBar.value = this.defaultProgress;
      }, 100);
    }
  }
}
