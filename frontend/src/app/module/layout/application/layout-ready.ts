export class LayoutReady {
  private static listeners: any[] = [];
  private static ready: boolean = false;
  private static elements: NodeListOf<HTMLElement>;
  private static promises: Promise<CustomElementConstructor>[] = [];

  public static init(): void {
    this.elements = document.querySelectorAll('*[wc-hidden], *[wc-lazy], *[wc-ready]');

    for (const element of this.elements) {
      const el: HTMLElement = element as HTMLElement;
      this.promises.push(window.customElements.whenDefined(el.localName));
    }

    Promise.all(this.promises).then(() => {
      this.ready = true;
      this.listeners.forEach(listener => listener());
      this.listeners = [];
      document.body.classList.add('layout-ready');
    });
  }

  public static onReady(listener: any): void {
    if (typeof listener === 'function') {
      if (this.ready) {
        listener();
      } else {
        this.listeners.push(listener);
      }
    }
  }
}
