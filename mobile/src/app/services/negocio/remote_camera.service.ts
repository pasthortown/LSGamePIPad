import { Injectable } from '@angular/core';
import * as io from 'socket.io-client';
import { Router } from '@angular/router';
import { environment } from './../../../environments/environment';
import { Observable } from 'rxjs';

@Injectable({
   providedIn: 'root'
})
export class RemoteCameraService {

   private socket;

   constructor(private router: Router) {
      this.socket = io(environment.remote_camera_url);
   }

   pedirImagen(message) {
      this.socket.emit('image', message);
   }

   getImages() {
      return Observable.create((observer) => {
         this.socket.on('message', (image) => {
            observer.next(image);
         });
      });
   }
}