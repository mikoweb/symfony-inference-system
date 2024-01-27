import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { LanguageInferenceResultsComponent } from './language-inference-results.component';
import { testProviders } from '@app/module/core/application/test/test-providers';

describe('LanguageInferenceResultsComponent', () => {
  let component: LanguageInferenceResultsComponent;
  let fixture: ComponentFixture<LanguageInferenceResultsComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [],
      providers: testProviders,
      imports: [
        LanguageInferenceResultsComponent,
        IonicModule.forRoot()
      ]
    }).compileComponents();

    fixture = TestBed.createComponent(LanguageInferenceResultsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
