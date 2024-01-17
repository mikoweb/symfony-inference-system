import { Component, ElementRef } from '@angular/core';
import { customElementParams } from '@app/module/core/application/custom-element/custom-element';

const { encapsulation, schemas } = customElementParams;

@Component({
  selector: ShadowDomStyleComponent.customElementName,
  templateUrl: './shadow-dom-style.component.html',
  styleUrls: ['./shadow-dom-style.component.scss'],
  standalone: true,
  encapsulation,
  schemas,
})
export class ShadowDomStyleComponent {
  public static readonly customElementName = 'app-shadow-dom-style';
}
