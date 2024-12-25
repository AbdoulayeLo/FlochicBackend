import {CanActivate, CanActivateFn, Router} from '@angular/router';
import {inject, Injectable} from "@angular/core";
import {LoginService} from "../../services/login.service";

export const adminGuard: CanActivateFn = (route, state) => {

  const  loginService=inject(LoginService);
  const router=inject(Router);

  if(loginService.isAuth()){
  return true;
  }
  router.navigate([loginService.redirectUrl])
  return false;

};



