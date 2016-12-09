<?php namespace App\Libraries;

use App\Libraries\FileUpload;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class System
{
    public static function upload($fileData)
    {
        $image = Input::file($fileData);
        $extension = $image->getClientOriginalExtension();
        $filename  = time().mt_rand(10000, 99999). '.' . $extension;
        if(!in_array(strtolower($extension), ["jpeg", "jpg", "png", "gif"])) {
            return false;
        }
        $path = public_path('uploads/' . $filename);
        $result = Image::make($image->getRealPath())->save($path);

        if (!$result) {
            return false;
        }

        return url('/')."/uploads/".$filename;
    }
}