import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ShadowDomStyleComponent } from './shadow-dom-style.component';

describe('ShadowDomStyleComponent', () => {
  let component: ShadowDomStyleComponent;
  let fixture: ComponentFixture<ShadowDomStyleComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [],
      imports: [
        ShadowDomStyleComponent,
        IonicModule.forRoot()
      ]
    }).compileComponents();

    fixture = TestBed.createComponent(ShadowDomStyleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
