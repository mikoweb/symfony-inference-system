import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { NgTemplateOutlet } from '@angular/common';

@Component({
  selector: 'app-lorem-ipsum-page',
  templateUrl: './lorem-ipsum-page.component.html',
  styleUrls: ['./lorem-ipsum-page.component.scss'],
  standalone: true,
  imports: [
    IonicModule,
    NgTemplateOutlet,
  ]
})
export class LoremIpsumPageComponent {
}
