import { CustomElementRegistry } from '@app/module/core/application/custom-element/custom-element';
import { ElementRef } from '@angular/core';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';

export default abstract class CustomElementBaseComponent {
  public static readonly customElementName: string;
  public static readonly ngSelectorName: string;
  public static readonly ngPrefix: string = 'ng';
  protected elementRef: ElementRef;

  public static register(): void {
    CustomElementRegistry.register(this);
  }

  protected constructor(
    elementRef: ElementRef,
    gsl: GlobalStyleLoader,
  ) {
    this.elementRef = elementRef;

    if (this.useGlobalStyle) {
      gsl.load(this.getShadowRoot());
    }
  }

  public getShadowRoot(): Document {
    return this.elementRef.nativeElement.shadowRoot;
  }

  protected get useGlobalStyle() {
    return false;
  }
}
