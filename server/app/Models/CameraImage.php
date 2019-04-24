<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'camera_image_file_type','camera_image_file_name','camera_image_file',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

}