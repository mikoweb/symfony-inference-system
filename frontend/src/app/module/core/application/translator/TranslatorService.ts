import { Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Injectable({
  providedIn: 'root',
})
export default class TranslatorService {
  constructor(
    private readonly translate: TranslateService
  ) {}

  public async get(key: string, interpolateParams?: Object): Promise<string> {
    return new Promise((resolve) => {
      this.translate.get(key, interpolateParams).subscribe((trans: string) => {
        resolve(trans);
      });
    });
  }
}
