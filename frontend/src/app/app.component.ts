import { ApplicationRef, Component, inject } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { CustomElementRegistry } from '@app/module/core/application/custom-element/custom-element';
import commandBusLoader from '@app/config/command-bus/loaders';
import CommandBus from '@app/module/core/application/command-bus/command-bus';
import LoadUserDataCommand from '@app/module/user/application/command/load-user-data-command';
import { LayoutReady } from '@app/module/layout/application/layout-ready';
import { LayoutInitializer } from '@app/module/layout/application/layout-initializer';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  standalone: true,
  imports: [IonicModule, CommonModule, RouterOutlet],
})
export class AppComponent {
  constructor(appRef: ApplicationRef) {
    this.initApp(appRef);
  }

  private async initApp(appRef: ApplicationRef) {
    commandBusLoader();
    const commandBus = inject(CommandBus);

    CustomElementRegistry.init(appRef);
    await import('../import-global-elements');

    commandBus.execute(new LoadUserDataCommand());

    LayoutReady.init();
    LayoutInitializer.init();
  }
}
