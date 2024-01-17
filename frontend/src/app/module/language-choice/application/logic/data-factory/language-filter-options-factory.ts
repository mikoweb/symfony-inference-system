import { Injectable } from '@angular/core';
import LanguageFilterOptionsDto from '@app/module/language-choice/domain/dto/language-filter-options-dto';
import SelectOptionDto from '@app/module/language-choice/domain/dto/select-option-dto';

@Injectable({
  providedIn: 'root',
})
export default class LanguageFilterOptionsFactory {
  public createOptions(data: any): LanguageFilterOptionsDto {
    const options: LanguageFilterOptionsDto = new LanguageFilterOptionsDto();

    for (const [key, items] of Object.entries(data)) {
      if (Array.isArray(items)) {
        options.set(key, items.map((option) => new SelectOptionDto(option.value ?? '', option.label ?? '')));
      }
    }

    return options;
  }
}
