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
  responsedata = new Search('', '', '', '', '', '', '');

  genres = ['','Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Drama', 'Family',
            'Fantasy', 'History', 'Horror', 'Romance', 'Romantic Comedy', 'Suspense/Thriller'];
  ratings = ['','G', 'PG', 'PG-13', 'R', 'NR/Unrated'];
  
  searchModel = new Search('The Patriot', 'Action', '2000', 'R', '200', 'Mel Gibson', 'Roland Emmerich');
 
  
  
  constructor(private http: HttpClient) { }

  senddata(data) {
     console.log(data);

     let params = JSON.stringify(data);
     

     //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
     this.http.get('http://localhost/Web-PL/angular/src/ngphp-get.php?str='+params)
     this.http.post('http://localhost/Web-PL/angular/src/ngphp-post.php', data)
     .subscribe((data) => {
        console.log('Got data from backend', data);
        //console.log(data[0].title);
        this.responsedata = <Search>data;
        let output = JSON.parse(JSON.stringify(this.responsedata))[0][0];
        let array = [output.title, output.genre, output.releaseDate, output.rating, output.duration,
                      output.actors, output.directors];
        console.log(array);
        window.location.href = 'http://localhost/Web-PL/movie-results.php?title='+array[0]+'&genre='+array[1]+
        '&releaseDate='+array[2]+'&rating='+array[3]+'&duration='+array[4]+'&actors='+array[5]+'&directors='+array[6];
     }, (error) => {
        console.log('Error', error);
     })
     
     
    
    //window.location.href = 'http://localhost/Web-PL/movie-results.php?'+title=data.title';
  }
  navigateToLogin(){
    window.location.href = 'http://localhost/Web-PL/login.php';
  }
  navigateToRegister(){
    window.location.href = 'http://localhost/Web-PL/register.php';
  }
}