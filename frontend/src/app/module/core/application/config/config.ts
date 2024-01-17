import { Injectable } from '@angular/core';
import { environment } from '../../../../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export default class Config {
  public getApiBaseUrl(): string {
    return this.getEnvData().apiBaseUrl ?? environment.apiBaseUrl;
  }

  public getEnvData(): any {
    return (window as any).Env ?? {};
  }
}
