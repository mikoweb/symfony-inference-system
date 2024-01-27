import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { DefaultPageComponent } from './default-page.component';
import { testProviders } from '@app/module/core/application/test/test-providers';

describe('DefaultPageComponent', () => {
  let component: DefaultPageComponent;
  let fixture: ComponentFixture<DefaultPageComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [],
      providers: testProviders,
      imports: [
        DefaultPageComponent,
        IonicModule.forRoot()
      ]
    }).compileComponents();

    // fixture = TestBed.createComponent(DefaultPageComponent);
    // component = fixture.componentInstance;
    // fixture.detectChanges();
  }));

  it('should create', () => {
    // expect(component).toBeTruthy();
  });
});
