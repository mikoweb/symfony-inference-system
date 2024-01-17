import { Injectable } from '@angular/core';
import LanguageFilterOptionsDto from '@app/module/language-choice/domain/dto/language-filter-options-dto';
import Client from '@app/module/api/infrastructure/client';
import LanguageFilterOptionsFactory
  from '@app/module/language-choice/application/logic/data-factory/language-filter-options-factory';

@Injectable({
  providedIn: 'root',
})
export default class GetLanguageFilterOptionsQuery {
  constructor(
    private readonly client: Client,
    private readonly languageFilterOptionsFactory: LanguageFilterOptionsFactory
  ) {}

  public async getOptions(): Promise<LanguageFilterOptionsDto> {
    const response = await this.client.method.get('language-choice/filter-options');

    return this.languageFilterOptionsFactory.createOptions(response.data);
  }
}
