import { Injectable } from '@angular/core';
import Client from '@app/module/api/infrastructure/client';
import LanguageInferenceResultDto from '@app/module/language-choice/domain/dto/language-inference-result-dto';
import MessageService from '@app/module/core/application/message/message-service';

@Injectable({
  providedIn: 'root',
})
export default class LanguageChoiceSender {
  constructor(
    private readonly client: Client,
    private readonly messageService: MessageService
  ) {}

  public async send(formData: any): Promise<LanguageInferenceResultDto[]> {
    let results: LanguageInferenceResultDto[] = [];
    let response: any = {};

    try {
      response = await this.client.method.post('language-choice/inference', formData);
    } catch (error: any) {
      const message = await this.client.getValidationError(error.response);
      await this.messageService.createError({message});
    }

    if (Array.isArray(response.data)) {
      results = response.data.map((result: any) => LanguageInferenceResultDto.createFromObject(result));
    }

    return results;
  }
}
