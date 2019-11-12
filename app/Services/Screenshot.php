<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Screenshot
{
    //
    public static function get_Screenshot($id, $url)
    {
     //return 'hell';
        $screen_shot_image = '';

            $url = "https://www.bayt.com/en/pakistan/";

            $screen_shot_json_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
            $screen_shot_result = json_decode($screen_shot_json_data, true);
            $screen_shot = $screen_shot_result['screenshot']['data'];
            $screen_shot = str_replace(array('_', '-'), array('/', '+'), $screen_shot);
            $screen_shot_image = "data:image/jpeg;base64," . $screen_shot;
            $content = base64_decode($screen_shot);

            $path='/var/www/html/salesportal/public/storage/customer'.$id.'.jpeg';

         //   $fileName='abc'.time().
            //$path = $file->storeAs('files', $fileName);





            $file = fopen($path, 'w');
            if (!is_resource($file)) { // Test if PHP could open the file
                echo "Could not open file for writting.";
                exit;
            }
            fwrite($file, $content);

            fclose($file);
           // echo "file closed";
            return $path;

            //imagejpeg($screen_shot_image, 'simpletext.jpg');

    }
}
