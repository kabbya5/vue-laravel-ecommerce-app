<?php 
namespace App\Classes;
use Image;

class ImageStore{
    private $img_upload_path;

    public function __construct($img,$img_upload_path,$width,$height){
        $this->uploadImg($img,$img_upload_path,$width,$height);
    }

    private function uploadImg($img,$img_upload_path,$width,$height){
        $position = strpos($img,';');
        $sub = substr($img,0,$position);
        $ext = explode('/',$sub)[1];
        $name = hexdec(uniqid()).time().'.'.$ext;
        $img = Image::make($img)->resize($width,$height)->save(storage_path('app/public/image/'.$img_upload_path .'/'.$name));

        $this->img_upload_path = '/storage/image/'.$img_upload_path .'/'.$name;

    }

    public function getImagePath(){
        return $this->img_upload_path;
    }
}