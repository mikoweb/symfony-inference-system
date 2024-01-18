import { Injectable } from '@angular/core';
import LanguageFilterOptionsDto from '@app/module/language-choice/domain/dto/language-filter-options-dto';
import SelectOptionDto from '@app/module/language-choice/domain/dto/select-option-dto';
import FilterPackageMap from '@app/module/language-choice/domain/filter/filter-package-map';

@Injectable({
  providedIn: 'root',
})
export default class LanguageFilterOptionsFactory {
  public createOptions(data: any): LanguageFilterOptionsDto {
    const options: LanguageFilterOptionsDto = new LanguageFilterOptionsDto();

    for (const [key, items] of Object.entries(data)) {
      if (Array.isArray(items)) {
        if (key === 'filterPackages') {
          this.createPackages(key, options, items);
        } else {
          this.createSelectOptions(key, options, items);
        }
      }
    }

    return options;
  }

  private createSelectOptions(key: string, options: LanguageFilterOptionsDto, items: Array<any>): void {
    options.set(key, items.map((option) => new SelectOptionDto(option.value ?? '', option.label ?? '')));
  }

  private createPackages(key: string, options: LanguageFilterOptionsDto, items: Array<any>): void {
    const filterPackages: FilterPackageMap = new FilterPackageMap();

    for (const item of items) {
      if (typeof item.name === 'string') {
        filterPackages.set(item.name, item.filter);
      }
    }

    options.set(key, filterPackages);
  }
}
