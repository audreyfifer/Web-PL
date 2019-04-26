import { Component } from '@angular/core';
import { Search } from './search';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'angular';
  responsedata = new Search('d', 'd', 'd', 'd', 'd', 'd', 'd');

  genres = ['','Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Drama', 'Family',
            'Fantasy', 'History', 'Horror', 'Romance', 'Romantic Comedy', 'Suspense/Thriller'];
  ratings = ['','G', 'PG', 'PG-13', 'R', 'NR/Unrated'];
  
  searchModel = new Search('', '', '', '', '', '', '');
  
  
  constructor(private http: HttpClient) { }
  senddata(data) {
     console.log(data);

     let params = JSON.stringify(data);

     //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
     this.http.get('http://localhost/Web-PL/angular/src/ngphp-get.php?str='+params)
     this.http.post('http://localhost/Web-PL/angular/src/ngphp-post.php', data)
     .subscribe((data) => {
        console.log('Got data from backend', data);
        this.responsedata = <Search>data;
     }, (error) => {
        console.log('Error', error);
     })
     //window.location.href = 'http://localhost/Web-PL/movie-results.php';
  }
  navigateToLogin(){
    window.location.href = 'http://localhost/Web-PL/login.php';
  }
  navigateToRegister(){
    window.location.href = 'http://localhost/Web-PL/register.php';
  }
}