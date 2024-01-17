import UserDataDTO from '@app/module/user/domain/dto/user-data-dto';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export default class UserDataPersistence {
  public save(userData: UserDataDTO): void {
    localStorage.setItem('userData', JSON.stringify(userData));
  }
}
