<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Browsershot\Browsershot;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\Storage;

class ScreenshotBS
{
    //
    public static function get_Screenshot($id, $url)
    {
     //return 'hell0';
   //  $url='https://icareers.alj.com/';
   //  $pathToImage='/var/www/html/salesportal/public/storage/customer'.$id.'.jpeg';
     $path=storage_path('app/public/customer'.$id.'.jpeg');
     $image=Browsershot::url($url)->setScreenshotType('jpeg',100)->windowSize(1920, 1080)
     ->fit(Manipulations::FIT_CONTAIN, 1000, 1000)->save($path);
    // \Storage::disk('local')->put('customer2.jpeg', $image);
     return (['path' => $path, 'url' => Storage::url('customer'.$id.'.jpeg')]);


    }
}
