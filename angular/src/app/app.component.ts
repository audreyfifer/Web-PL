declare var require: any
import { Component, OnInit } from '@angular/core';
import { Search } from './search';
import { User } from './user';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'angular';
  responsedata = new Search('', '', '', '', '', '', '');

  genres = ['','Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Drama', 'Family',
            'Fantasy', 'History', 'Horror', 'Romance', 'Romantic Comedy', 'Suspense/Thriller'];
  ratings = ['','G', 'PG', 'PG-13', 'R', 'NR/Unrated'];
  
  searchModel = new Search('The Patriot', 'Action', '2000', 'R', '200', 'Mel Gibson', 'Roland Emmerich');
  userModel = new User('false');
  logged_in=false;

  constructor(private http: HttpClient) { }
  
  getSessionData() {
    var data = require('C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json');
    this.logged_in = data[0]['logged_in']=="true";
  }
  

  senddata(data) {
     console.log(data);

     let params = JSON.stringify(data);
     

     //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
     //this.http.get('http://localhost/Web-PL/angular/src/ngphp-get.php?str='+params)
     this.http.post('http://localhost/Web-PL/angular/src/ngphp-post.php', data)
     .subscribe((data) => {
        console.log('Got data from backend', data);
        //console.log(data[0].title);
        this.responsedata = <Search>data;
        let output = JSON.parse(JSON.stringify(this.responsedata))[0][0];
        let string="";
        if (output.title!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='title='+output.title;
        }
        if (output.genre!=""){
          string+=string.length>0 ? '&' : '?';
          string+='genre='+output.genre;
        }
        if (output.releaseDate!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='releaseDate='+output.releaseDate;
        }
        if (output.rating!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='rating='+output.rating;
        }
        if (output.duration!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='duration='+output.duration;
        }
        if (output.actors!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='actors='+output.actors;
        }
        if (output.directors!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='directors='+output.directors;
        }
        if (output.title!=""){ 
          string+=string.length>0 ? '&' : '?';
          string+='title='+output.title;
        }
       
        console.log(string);
        window.location.href = 'http://localhost/Web-PL/movie-results.php'+string;
        
     }, (error) => {
        //console.log('Error', error);
     })
     
     
    
    //window.location.href = 'http://localhost/Web-PL/movie-results.php?'+title=data.title';
  }
  navigateToLogin(){
    window.location.href = 'http://localhost/Web-PL/login.php';
  }
  navigateToRegister(){
    window.location.href = 'http://localhost/Web-PL/register.php';
  }
  navigateToHome(){
    window.location.href = 'http://localhost:4200';
  }
  navigateToProfile(){
    window.location.href = 'http://localhost/Web-PL/profile.php';
  }

  ngOnInit() {
    this.getSessionData();
  }
}