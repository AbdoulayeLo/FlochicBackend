import {Component, OnInit} from '@angular/core';
import {Router, RouterLink} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {RegisterService} from "../../../services/register.service";
import {response} from "express";
import {LoginService} from "../../../services/login.service";

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent implements OnInit{
  constructor(private formBuilder: FormBuilder,
              private loginService: LoginService,
              private router: Router) {
  }

  verifForm = false;
  RegisterForm=this.formBuilder.group({
    name: ['', [Validators.required]],
    email: ['', [Validators.required, Validators.email]],
    passoword:['', Validators.required],
  });

  ngOnInit() {
  }

  Register(){
    this.verifForm=true;
    if (this.RegisterForm.valid){
      this.loginService.getRegister(this.RegisterForm.value).subscribe(
        (response)=>{

        }
      )
    }
  }
}
