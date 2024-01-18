import SelectOptionDto from '@app/module/language-choice/domain/dto/select-option-dto';
import FilterPackageMap from '@app/module/language-choice/domain/filter/FilterPackageMap';

export default class LanguageFilterOptionsDto extends Map<string, SelectOptionDto[] | FilterPackageMap> {
  public getOptions(name: string): SelectOptionDto[] {
    return (this.get(name) ?? []) as SelectOptionDto[];
  }

  public getFilterPackages(): FilterPackageMap | null {
    return (this.get('filterPackages') ?? null) as FilterPackageMap | null;
  }
}
