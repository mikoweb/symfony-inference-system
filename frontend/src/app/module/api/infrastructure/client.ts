import { Injectable } from '@angular/core';
import axios, { CreateAxiosDefaults } from 'axios';
import Config from '@app/module/core/application/config/config';
import TranslatorService from '@app/module/core/application/translator/TranslatorService';

@Injectable({
  providedIn: 'root',
})
export default class Client {
  private client: any;

  constructor(
    private readonly config: Config,
    private readonly translator: TranslatorService
  ) {
    this.init();
  }

  public get method() {
    return this.client;
  }

  public async getValidationError(errorResponse: any): Promise<string> {
    const detail = errorResponse?.data?.detail;

    if (errorResponse.status === 422 && typeof detail === 'string' && detail.length > 0) {
      return detail;
    } else {
      return await this.translator.get('api_client.common_validation_error');
    }
  }

  private init() {
    const apiPath = '/api/';
    this.client = axios.create({
      baseURL: (this.config.getApiBaseUrl() + apiPath).replace(`/${apiPath}`, apiPath)
    } as CreateAxiosDefaults);
  }
}
