import { provideRouter } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import TranslateModuleFacade from '@app/module/core/application/translator/TranslateModuleFacade';
import { importProvidersFrom, LOCALE_ID } from '@angular/core';
import { environment } from '../../../../../environments/environment';
import { IonicModule } from '@ionic/angular';

export const testProviders = [
  { provide: LOCALE_ID, useValue: environment.defaultLanguage },
  importProvidersFrom([
    IonicModule.forRoot({}),
    HttpClientModule,
    TranslateModuleFacade.forRoot(),
  ]),
  provideRouter([]),
];
