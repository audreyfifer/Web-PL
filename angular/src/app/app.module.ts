import {  BrowserModule } from '@angular/platform-browser';
import {  NgModule,
          OnInit } from '@angular/core';
import {  FormsModule,
          FormGroup,
          FormControl,
          Validators} from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})


/*
class ModelFormComponent implements OnInit {
  myform: FormGroup;
  title: FormControl;
  genre: FormControl;
  releaseDate: FormControl;
  rating: FormControl;
  duration: FormControl;
  actors: FormControl;
  directors: FormControl;


  ngOnInit() {
    this.createFormControls();
    this.createForm();
  }

  createFormControls() {
    this.title = new FormControl('');
    this.genre = new FormControl('');
    this.releaseDate = new FormControl('',Validators.pattern("^[0-9]+$"));
    this.rating = new FormControl('');
    this.duration = new FormControl('', Validators.pattern("^([\t\s]*([12][0-9]{3}[s]?|[12][0-9]{3}'s|[12][0-9]{3}-[12][0-9]{3}|[0-9]{1}0s|[0-9]{1}0's)[\t\s]*)$"));
    this.actors = new FormControl('');
    this.directors = new FormControl('');
  }

  createForm() {
    this.myform = new FormGroup({
      title: this.title,
      genre: this.genre,
      releaseDate: this.releaseDate,
      rating: this.rating,
      duration: this.duration,
      actors: this.actors,
      directors: this.directors
    });
  }
}
*/
export class AppModule { }
