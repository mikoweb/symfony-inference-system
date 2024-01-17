import { Routes } from '@angular/router';
import { PageNotFoundComponent } from '@app/module/pages/application/pages/page-not-found/page-not-found.component';
import { DefaultPageComponent } from '@app/module/pages/application/pages/default-page/default-page.component';

export const pagesRoutes: Routes = [
  {
    path: '',
    component: DefaultPageComponent
  },
  {
    path: '**',
    component: PageNotFoundComponent
  }
];
