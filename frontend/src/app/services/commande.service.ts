import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Commande} from "../model/commande";

@Injectable({
  providedIn: 'root'
})
export class CommandeService {

  constructor(private httpClient: HttpClient) { }

  getAllCommandes():Observable<Commande[]>{
    return this.httpClient.get<Commande[]>('http://127.0.0.1:8000/api/commandes');
  }

  AjouterCommande(commande:any){
    return this.httpClient.post('http://127.0.0.1:8000/api/commandes',commande);
  }
}
