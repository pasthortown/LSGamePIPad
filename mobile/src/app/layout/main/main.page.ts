import { RemoteCameraService } from 'src/app/services/negocio/remote_camera.service';
import { environment } from './../../../environments/environment';
import { Component, OnInit } from '@angular/core';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';
import { DeviceMotion, DeviceMotionAccelerationData, DeviceMotionAccelerometerOptions } from '@ionic-native/device-motion/ngx';

@Component({
  selector: 'app-main',
  templateUrl: './main.page.html',
  styleUrls: ['./main.page.scss'],
})
export class MainPage implements OnInit {
  appName = environment.app_name;
  options: DeviceMotionAccelerometerOptions;
  x: number;
  y: number;
  z: number;
  captura = '';
  direction = 'detenido';
  constructor(private screenOrientation: ScreenOrientation,
              private remoteCameraDataService: RemoteCameraService,
              private deviceMotion: DeviceMotion) {
    this.screenOrientation.lock(this.screenOrientation.ORIENTATIONS.LANDSCAPE);
  }

  ngOnInit() {
    this.startMotionDetection();
    this.listenRemoteCamera();
    this.initCapture();
  }

  initCapture() {
    this.remoteCameraDataService.pedirImagen('request');
    if (true) {
      setTimeout(() => {
        this.initCapture();
      }, 100);
    }
  }

  listenRemoteCamera() {
    this.remoteCameraDataService.getImages()
    .subscribe(r => {
      this.captura = 'data:image/png;base64,' + JSON.parse(r).data;
    });
  }

  startMotionDetection() {
    this.options = {frequency:10};
    this.deviceMotion.watchAcceleration(this.options).subscribe((acceleration: DeviceMotionAccelerationData) => {
      this.x = acceleration.x;
      this.y = acceleration.y;
      this.z = acceleration.z;
    });
  }

  acelerar() {
    this.direction = 'acelerando';
  }

  reversa() {
    this.direction = 'reversa';
  }

  detener() {
    this.direction = 'detenido';
  }
}
