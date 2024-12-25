import { Routes } from '@angular/router';
import {LoginComponent} from "./pages/authentification/login/login.component";
import {RegisterComponent} from "./pages/authentification/register/register.component";
import {AppComponent} from "./app.component";
import {ProduitComponent} from "./pages/produit/produit.component";
import {DashboardComponent} from "./pages/dashboard/dashboard/dashboard.component";
import {AjoutProduitComponent} from "./pages/produit/ajout-produit/ajout-produit.component";
import {PagenotfoundComponent} from "./pages/pagenotfound/pagenotfound.component";
import {adminGuard} from "./pages/guard/admin.guard";
import {CommandeComponent} from "./pages/commande/commande.component";
import {AddCommandeComponent} from "./pages/add-commande/add-commande.component";

export const routes: Routes = [
  { path: '', redirectTo: '/produits', pathMatch: 'full' }, // Redirection par défaut
  {path:'produits',component:ProduitComponent ,pathMatch:'full'},
  {path:'ajoutProduit',component:AjoutProduitComponent},
  {path:'login',component:LoginComponent},
  {path:'register',component:RegisterComponent},
  {path:'commande',component:CommandeComponent},
  {path:'addCommande',component:AddCommandeComponent},
  {path:'dashboard',component:DashboardComponent},
  {path:'**',component:PagenotfoundComponent}
  // ,canActivate:[adminGuard]
];
