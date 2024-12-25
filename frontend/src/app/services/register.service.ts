import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {AuthResponse} from "../model/auth-response";

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  constructor(private httpClient: HttpClient) { }

  getRegister(request:any): Observable<AuthResponse> {
    return this.httpClient.post<AuthResponse>("http://127.0.0.1:8000/api/register", request);
  }
}
