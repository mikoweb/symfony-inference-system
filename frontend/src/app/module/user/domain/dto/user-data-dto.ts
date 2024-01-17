export default class UserDataDTO {
  constructor(
    public readonly firstName?: string,
    public readonly lastName?: string,
    public readonly email?: string,
  ) {}

  public static createFromObject(data: any) {
    return new UserDataDTO(
      data.firstName,
      data.lastName,
      data.email
    );
  }
}
