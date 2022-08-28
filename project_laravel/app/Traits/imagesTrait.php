<?php

namespace App\Traits;


use Illuminate\Support\Facades\File;

trait imagesTrait
{

    function saveImages($photo, $folder)
    {
        $filename = $photo->getClientOriginalName();
        $f_name_array = explode('.', $filename);
        $f_file_name = $f_name_array[0];
        $f_file_ext = end($f_name_array);
        $file_name = microtime().'.'.$f_file_ext;
        $photo->move($folder, $file_name);
        return $file_name;
    }

    function deleteImages($file_path)
    {
        if(File::exists($file_path)){
            File::delete($file_path);
            return true;
        }else{
            return false;
        }
    }

}




