export default class LanguageInferenceResultDto {
  constructor(
    public readonly langId: string,
    public readonly score: number,
    public readonly name: string,
    public readonly usage: string[],
    public readonly features: string[],
  ) {}

  public static createFromObject(data: any): LanguageInferenceResultDto {
    return new LanguageInferenceResultDto(
      data.langId,
      data.score,
      data.name,
      data.usage,
      data.features,
    );
  }
}
