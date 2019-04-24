import { Component, OnInit } from '@angular/core';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';
import { DeviceMotion, DeviceMotionAccelerationData, DeviceMotionAccelerometerOptions } from '@ionic-native/device-motion/ngx';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit{
  options: DeviceMotionAccelerometerOptions;
  x: number;
  y: number;
  z: number;
  
  constructor(private screenOrientation: ScreenOrientation,
              private deviceMotion: DeviceMotion) {
    this.screenOrientation.lock(this.screenOrientation.ORIENTATIONS.LANDSCAPE);
  }

  ngOnInit() {
    this.startMotionDetection();
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
    alert(1);
  }

  reversa() {
    alert(2);
  }
}
