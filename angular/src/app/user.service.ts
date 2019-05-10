import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class UserService {
  constructor(
    private http: HttpClient,
    public logged : string = "false"
    ) { }
    configUrl = 'assets/logged_in.json';

    getConfig() {
      return this.http.get(this.configUrl);
    }
}
