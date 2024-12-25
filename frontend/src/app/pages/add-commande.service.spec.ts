import { TestBed } from '@angular/core/testing';

import { AddCommandeService } from './add-commande.service';

describe('AddCommandeService', () => {
  let service: AddCommandeService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AddCommandeService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
