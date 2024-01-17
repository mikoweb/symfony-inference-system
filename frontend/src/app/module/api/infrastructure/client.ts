import { Injectable } from '@angular/core';
import axios, { CreateAxiosDefaults } from 'axios';
import Config from '@app/module/core/application/config/config';

@Injectable({
  providedIn: 'root',
})
export default class Client {
  private client: any;

  constructor(
    private readonly config: Config
  ) {
    this.init();
  }

  public get method() {
    return this.client;
  }

  private init() {
    const apiPath = '/api/';
    this.client = axios.create({
      baseURL: (this.config.getApiBaseUrl() + apiPath).replace(`/${apiPath}`, apiPath)
    } as CreateAxiosDefaults);
  }
}
