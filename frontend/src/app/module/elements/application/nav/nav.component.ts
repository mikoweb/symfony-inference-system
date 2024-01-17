import { Component, ElementRef } from '@angular/core';
import { NavBehavior } from './nav-behavior';
import { Router } from '@angular/router';
import { CustomElement, customElementParams } from '@app/module/core/application/custom-element/custom-element';
import CustomElementBaseComponent from '@app/module/core/application/custom-element/custom-element-base-component';
import GlobalStyleLoader from '@app/module/core/application/custom-element/global-style-loader';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: NavComponent.customElementName,
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
})
@CustomElement()
export class NavComponent extends CustomElementBaseComponent {
  public static override readonly customElementName = 'app-nav';

  constructor(
    ele: ElementRef,
    gsl: GlobalStyleLoader,
    router: Router,
  ) {
    super(ele, gsl);
    new NavBehavior(ele.nativeElement, router);
  }
}
