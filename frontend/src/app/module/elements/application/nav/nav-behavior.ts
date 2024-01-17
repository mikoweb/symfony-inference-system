import Behavior from '@app/module/core/application/behavior/behavior';
import BehaviorEvent from '@app/module/core/application/behavior/value-object/behavior-event';
import { Router } from '@angular/router';

export class NavBehavior extends Behavior {
  constructor(
    element: Element,
    private readonly router: Router
  ) {
    super(element);
    this.initNav();
  }

  protected get events(): BehaviorEvent[] {
    return [
      new BehaviorEvent('click', (event: Event) => this.onAnchorClick(event), 'a'),
      new BehaviorEvent('click', (event: Event) => this.onIonItemClick(event), 'ion-item'),
    ];
  }

  private initNav(): void {
    setTimeout(() => {
      for (const anchor of this.getAllAnchorsQuery()) {
        const href: string = this.getAnchorHref(anchor);

        if (href === this.router.url) {
          this.setActive(anchor);
          break;
        }
      }
    }, 200);
  }

  private onIonItemClick(event: Event): void {
    event.preventDefault();
    event.stopPropagation();
    const element = event.target as HTMLElement;

    if (element.tagName === 'ION-ITEM') {
      const anchor: HTMLAnchorElement | null = element.querySelector('a');

      if (anchor) {
        this.clickAnchor(anchor);
      }
    }
  }

  private onAnchorClick(event: Event): void {
    event.preventDefault();
    event.stopPropagation();
    const tagName = (event.target as HTMLElement).tagName;

    if (tagName === 'A') {
      const anchor: HTMLAnchorElement | null = event.target as HTMLAnchorElement | null;

      if (anchor) {
        this.clickAnchor(anchor);
      }
    }
  }

  private clickAnchor(anchor: HTMLAnchorElement) {
    this.router.navigate([this.getAnchorHref(anchor)]);

    this.setActive(anchor);
  }

  private setActive(anchor: HTMLAnchorElement): void {
    for (const el of this.getAllAnchorsQuery()) {
      const elements = [el, el.closest('ion-item'), el.closest('li')];

      for (const item of elements) {
        if (item) {
          item.classList.remove('active');
        }
      }
    }

    const elements = [anchor, anchor.closest('ion-item'), anchor.closest('li')];

    for (const item of elements) {
      if (item) {
        item.classList.add('active');
      }
    }
  }

  private getAllAnchorsQuery(): NodeListOf<HTMLAnchorElement> {
    return this.element.querySelectorAll('a');
  }

  private getAnchorHref(anchor: HTMLAnchorElement): string {
    return anchor.getAttribute('href') ?? '';
  }
}
