import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { LanguageChoiceFormComponent } from './language-choice-form.component';
import { testProviders } from '@app/module/core/application/test/test-providers';

describe('LanguageChoiceFormComponent', () => {
  let component: LanguageChoiceFormComponent;
  let fixture: ComponentFixture<LanguageChoiceFormComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [],
      providers: testProviders,
      imports: [
        LanguageChoiceFormComponent,
        IonicModule.forRoot()
      ]
    }).compileComponents();

    // fixture = TestBed.createComponent(LanguageChoiceFormComponent);
    // component = fixture.componentInstance;
    // fixture.detectChanges();
  }));

  it('should create', () => {
    // expect(component).toBeTruthy();
  });
});
