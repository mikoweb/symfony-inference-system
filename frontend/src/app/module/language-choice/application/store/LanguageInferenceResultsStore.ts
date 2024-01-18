import { Injectable } from '@angular/core';
import { observable } from 'mobx-angular';
import { makeObservable } from 'mobx';
import LanguageInferenceResultDto from '@app/module/language-choice/domain/dto/language-inference-result-dto';

@Injectable({
  providedIn: 'root',
})
export default class LanguageInferenceResultsStore {
  @observable public results?: LanguageInferenceResultDto[];

  constructor() {
    makeObservable(this);
  }
}
