import { Routes } from '@angular/router';
import { CardsDemoPageComponent } from './pages/cards-demo-page/cards-demo-page.component';
import { UserDataPageComponent } from './pages/user-data-page/user-data-page.component';
import { LoremIpsumPageComponent } from './pages/lorem-ipsum-page/lorem-ipsum-page.component';

export const pagesRoutes: Routes = [
  {
    path: 'page/cards-demo',
    component: CardsDemoPageComponent
  },
  {
    path: 'page/user-data',
    component: UserDataPageComponent
  },
  {
    path: 'page/lorem-ipsum',
    component: LoremIpsumPageComponent
  },
  {
    path: '',
    redirectTo: 'page/cards-demo',
    pathMatch: 'full',
  },
];
