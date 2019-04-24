<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Exception;
use App\CameraImage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CameraImageController extends Controller
{
    function get(Request $data)
    {
       $id = $data['id'];
       if ($id == null) {
          return response()->json(CameraImage::get(),200);
       } else {
          $cameraimage = CameraImage::findOrFail($id);
          $attach = [];
          return response()->json(["CameraImage"=>$cameraimage, "attach"=>$attach],200);
       }
    }

    function paginate(Request $data)
    {
       $size = $data['size'];
       return response()->json(CameraImage::paginate($size),200);
    }

    function post(Request $data)
    {
       try{
          DB::beginTransaction();
          $result = $data->json()->all();
          $cameraimage = new CameraImage();
          $lastCameraImage = CameraImage::orderBy('id')->get()->last();
          if($lastCameraImage) {
             $cameraimage->id = $lastCameraImage->id + 1;
          } else {
             $cameraimage->id = 1;
          }
          $cameraimage->camera_image_file_type = $result['camera_image_file_type'];
          $cameraimage->camera_image_file_name = $result['camera_image_file_name'];
          $cameraimage->camera_image_file = $result['camera_image_file'];
          $cameraimage->save();
          DB::commit();
       } catch (Exception $e) {
          return response()->json($e,400);
       }
       return response()->json($cameraimage,200);
    }

    function put(Request $data)
    {
       try{
          DB::beginTransaction();
          $result = $data->json()->all();
          $cameraimage = CameraImage::where('id',$result['id'])->update([
             'camera_image_file_type'=>$result['camera_image_file_type'],
             'camera_image_file_name'=>$result['camera_image_file_name'],
             'camera_image_file'=>$result['camera_image_file'],
          ]);
          DB::commit();
       } catch (Exception $e) {
          return response()->json($e,400);
       }
       return response()->json($cameraimage,200);
    }

    function delete(Request $data)
    {
       $id = $data['id'];
       return CameraImage::destroy($id);
    }

    function backup(Request $data)
    {
       $cameraimages = CameraImage::get();
       $toReturn = [];
       foreach( $cameraimages as $cameraimage) {
          $attach = [];
          array_push($toReturn, ["CameraImage"=>$cameraimage, "attach"=>$attach]);
       }
       return response()->json($toReturn,200);
    }

    function masiveLoad(Request $data)
    {
      $incomming = $data->json()->all();
      $masiveData = $incomming['data'];
      try{
       DB::beginTransaction();
       foreach($masiveData as $row) {
         $result = $row['CameraImage'];
         $exist = CameraImage::where('id',$result['id'])->first();
         if ($exist) {
           CameraImage::where('id', $result['id'])->update([
             'camera_image_file_type'=>$result['camera_image_file_type'],
             'camera_image_file_name'=>$result['camera_image_file_name'],
             'camera_image_file'=>$result['camera_image_file'],
           ]);
         } else {
          $cameraimage = new CameraImage();
          $cameraimage->id = $result['id'];
          $cameraimage->camera_image_file_type = $result['camera_image_file_type'];
          $cameraimage->camera_image_file_name = $result['camera_image_file_name'];
          $cameraimage->camera_image_file = $result['camera_image_file'];
          $cameraimage->save();
         }
       }
       DB::commit();
      } catch (Exception $e) {
         return response()->json($e,400);
      }
      return response()->json('Task Complete',200);
    }
}