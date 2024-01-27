import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { environment } from '../../../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { ModuleWithProviders } from '@angular/core';

export function HttpLoaderFactory(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}

export default class TranslateModuleFacade {
  public static forRoot(): ModuleWithProviders<TranslateModule> {
    return TranslateModule.forRoot({
      defaultLanguage: environment.defaultLanguage,
      useDefaultLang: true,
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient],
      }
    });
  }
}
