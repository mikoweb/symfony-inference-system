import { Routes } from '@angular/router';
import { pagesRoutes } from '@app/module/pages/application/pages.routes';

export const routes: Routes = [
  {
    path: '',
    children: pagesRoutes
  }
];
