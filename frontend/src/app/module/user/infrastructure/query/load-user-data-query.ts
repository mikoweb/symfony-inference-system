import UserDataDTO from '@app/module/user/domain/dto/user-data-dto';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export default class LoadUserDataQuery {
  public load(): UserDataDTO {
    const data = localStorage.getItem('userData') ?? '{}';

    return UserDataDTO.createFromObject(JSON.parse(data));
  }
}
