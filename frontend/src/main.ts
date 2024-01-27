import {
  enableProdMode,
  EnvironmentProviders,
  importProvidersFrom,
  LOCALE_ID,
  Provider
} from '@angular/core';
import { bootstrapApplication } from '@angular/platform-browser';
import { RouteReuseStrategy, provideRouter } from '@angular/router';
import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { configure } from 'mobx';

configure({
  enforceActions: 'never',
});

import { routes } from '@app/app.routes';
import { AppComponent } from '@app/app.component';
import { environment } from './environments/environment';
import { HttpClientModule } from '@angular/common/http';
import { registerLocaleData } from '@angular/common';
import localePl from '@angular/common/locales/pl';
import TranslateModuleFacade from '@app/module/core/application/translator/TranslateModuleFacade';

if (environment.production) {
  enableProdMode();
}

registerLocaleData(localePl);

const providers: Array<Provider | EnvironmentProviders> = [
  { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
  { provide: LOCALE_ID, useValue: environment.defaultLanguage },
  importProvidersFrom(
    IonicModule.forRoot({}),
    HttpClientModule,
    TranslateModuleFacade.forRoot(),
  ),
  provideRouter(routes),
];

bootstrapApplication(AppComponent, {
  providers,
});
