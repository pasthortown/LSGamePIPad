import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { MainPage } from './main.page';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';
import { DeviceMotion } from '@ionic-native/device-motion/ngx';
import { RemoteCameraService } from 'src/app/services/negocio/remote_camera.service';

const routes: Routes = [
  {
    path: '',
    component: MainPage
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RouterModule.forChild(routes)
  ],
  declarations: [MainPage],
  providers: [ScreenOrientation, DeviceMotion, RemoteCameraService]
})
export class MainPageModule {}
