import { Component } from '@angular/core';
import { Search } from './search';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'angularAssignment';
  genres = ['','Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Drama', 'Family',
            'Fantasy', 'History', 'Horror', 'Romance', 'Romantic Comedy', 'Suspense/Thriller'];
  ratings = ['','G', 'PG', 'PG-13', 'R', 'NR/Unrated'];
  searchModel = new Search('', '', '', '', '', '', '');
}