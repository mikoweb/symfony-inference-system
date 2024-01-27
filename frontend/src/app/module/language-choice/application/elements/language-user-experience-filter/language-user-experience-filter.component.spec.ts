import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { LanguageUserExperienceFilterComponent } from './language-user-experience-filter.component';
import { testProviders } from '@app/module/core/application/test/test-providers';

describe('LanguageUserExperienceFilterComponent', () => {
  let component: LanguageUserExperienceFilterComponent;
  let fixture: ComponentFixture<LanguageUserExperienceFilterComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [],
      providers: testProviders,
      imports: [
        LanguageUserExperienceFilterComponent,
        IonicModule.forRoot()
      ]
    }).compileComponents();

    // fixture = TestBed.createComponent(LanguageUserExperienceFilterComponent);
    // component = fixture.componentInstance;
    // fixture.detectChanges();
  }));

  it('should create', () => {
    // expect(component).toBeTruthy();
  });
});
