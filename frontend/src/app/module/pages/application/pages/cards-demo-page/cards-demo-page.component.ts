import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { NgForOf } from '@angular/common';

@Component({
  selector: 'app-cards-demo-page',
  templateUrl: './cards-demo-page.component.html',
  styleUrls: ['./cards-demo-page.component.scss'],
  standalone: true,
  imports: [
    IonicModule,
    NgForOf
  ]
})
export class CardsDemoPageComponent {
  protected cols: number[] = new Array(3).fill(0);
  protected rows: number[] = new Array(10).fill(0);
}
