export default class SelectOptionDto {
  constructor(
    public readonly value: string | number,
    public readonly label: string,
  ) {}
}
