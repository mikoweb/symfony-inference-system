export default class LanguageData {
  constructor(
    public readonly id: string,
    public readonly name: string,
    public readonly objectOriented: boolean,
    public readonly functional: boolean,
    public readonly procedural: boolean,
    public readonly reflective: boolean,
    public readonly eventDriven: boolean,
  ) {}

  public static createFromObject(data: any): LanguageData {
    return new LanguageData(
      data.id ?? '',
      data.name ?? '',
      data.objectOriented ?? false,
      data.functional ?? false,
      data.procedural ?? false,
      data.reflective ?? false,
      data.eventDriven ?? false,
    );
  }
}
