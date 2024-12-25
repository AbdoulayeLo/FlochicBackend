import {Component, OnInit} from '@angular/core';
import {CommandeService} from "../../services/commande.service";
import {response} from "express";
import {Commande} from "../../model/commande";

@Component({
  selector: 'app-commande',
  standalone: true,
  imports: [],
  templateUrl: './commande.component.html',
  styleUrl: './commande.component.css'
})
export class CommandeComponent implements OnInit{
tabCommand:Commande[]=[]
  ngOnInit() {
  this.AllCommande()
  }
    constructor(private commandeService: CommandeService) {}

  AllCommande(){
    this.commandeService.getAllCommandes().subscribe(
      (data:Commande[])=>{
        this.tabCommand=data;
        console.log(this.tabCommand)
      },
      (error)=>{
        console.log("Aucun produit commander",error.message)
      }
    )
  }

}
