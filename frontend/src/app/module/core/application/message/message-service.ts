import { Injectable } from '@angular/core';
import { ToastController, ToastOptions } from '@ionic/angular';

@Injectable({
  providedIn: 'root',
})
export default class MessageService {
  private readonly defaultOptions: ToastOptions = {
    duration: 2000,
    position: 'bottom',
    buttons: [{
      text: '✖',
      role: 'cancel',
    }]
  };

  constructor(
    private toastController: ToastController
  ) {}

  public async createMessage(options: ToastOptions) {
    const toast = await this.toastController.create(this.mergeWithDefault(options));

    return await toast.present();
  }

  public async createSuccess(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'success'}));
  }

  public async createError(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'danger'}));
  }

  public async createWarning(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'warning'}));
  }

  public async createInfo(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'secondary'}));
  }

  private mergeWithDefault(options: ToastOptions): ToastOptions {
    return this.mergeOptions(this.defaultOptions, options);
  }

  private mergeOptions(a: ToastOptions, b: ToastOptions): ToastOptions {
    return {...a, ...b};
  }
}
