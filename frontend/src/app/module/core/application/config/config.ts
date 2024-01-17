import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export default class Config {
  public getApiBaseUrl(): string {
    return this.getEnvData().apiBaseUrl ?? '/';
  }

  public getEnvData(): any {
    return (window as any).Env ?? {};
  }
}
