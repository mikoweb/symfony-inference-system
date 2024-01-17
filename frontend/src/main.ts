import { enableProdMode, EnvironmentProviders, importProvidersFrom, Provider } from '@angular/core';
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
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';

if (environment.production) {
  enableProdMode();
}

export function HttpLoaderFactory(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}

const providers: Array<Provider | EnvironmentProviders> = [
  { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
  importProvidersFrom(
    IonicModule.forRoot({}),
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage: environment.defaultLanguage,
      useDefaultLang: true,
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient]
      }
    })
  ),
  provideRouter(routes),
];

bootstrapApplication(AppComponent, {
  providers,
});
