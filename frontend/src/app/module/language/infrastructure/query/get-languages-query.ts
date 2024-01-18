import { Injectable } from '@angular/core';
import Client from '@app/module/api/infrastructure/client';
import LanguageData from '@app/module/language/domain/language-data';

@Injectable({
  providedIn: 'root',
})
export default class GetLanguagesQuery {
  private static languages: LanguageData[] | null = null;

  constructor(
    private readonly client: Client,
  ) {}

  public async getLanguages(): Promise<LanguageData[] | null> {
    if (GetLanguagesQuery.languages === null) {
      const response = await this.client.method.get('language/');

      GetLanguagesQuery.languages = Array.isArray(response.data)
        ? response.data.map((language: any) => LanguageData.createFromObject(language))
        : [];
    }

    return GetLanguagesQuery.languages;
  }
}
