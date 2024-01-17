import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { UserDataFormComponent } from '@app/module/user/application/elements/user-data-form/user-data-form.component';

@Component({
  selector: 'app-user-data-page',
  templateUrl: './user-data-page.component.html',
  styleUrls: ['./user-data-page.component.scss'],
  standalone: true,
  imports: [
    IonicModule,
    UserDataFormComponent
  ]
})
export class UserDataPageComponent {
}
