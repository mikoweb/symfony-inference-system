import { computed, observable } from 'mobx-angular';
import { Injectable } from '@angular/core';
import { makeObservable } from 'mobx';
import UserDataDTO from '@app/module/user/domain/dto/user-data-dto';

@Injectable({
  providedIn: 'root',
})
export default class UserDataStore {
  @observable public firstName?: string;
  @observable public lastName?: string;
  @observable public email?: string;

  constructor() {
    makeObservable(this);
  }

  @computed get fullName() {
    const fullName = `${this.firstName ?? ''} ${this.lastName ?? ''}`.trim();

    return fullName.length > 0 ? fullName : 'Guest';
  }

  public loadFromDTO(dto: UserDataDTO): void {
    this.firstName = dto.firstName;
    this.lastName = dto.lastName;
    this.email = dto.email;
  }
}
