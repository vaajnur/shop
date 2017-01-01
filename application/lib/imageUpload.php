<?php

namespace Lib;

class Lib_ImageUpload
{
    /**
     * @param $tmp_name
     * @param $file
     * @param $path_to_save
     * @return array
     */
    public function upload_image($tmp_name, $file, $path_to_save)
    {
        error_reporting(0);
        $mess = array();
        foreach ($tmp_name as $key => $value) {
            /* ************* stamp */
            $stamp = imagecreatefrompng('images/stamp.png');
            $type = strtolower(substr(strrchr($file[$key], "."), 1));

            if ($type == 'jpeg') $type = 'jpg';
            switch ($type) {
                case 'bmp':
                    $img = imagecreatefromwbmp($value);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($value);
                    break;
                case 'jpg':
                    $img = imagecreatefromjpeg($value);
                    break;
                case 'png':
                    $img = imagecreatefrompng($value);
                    break;
                case '':
                    return;
                default :
                    return $mess[$file[$key]][] = "Unsupported picture type!" . $type;
            }

            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

            $imagecopy_mess = null;
            if($img != false){
                $imagecopy_mess = imagecopy($img, $stamp, imagesx($img) - $sx - $marge_right, imagesy($img) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
            }
            if ($imagecopy_mess != true) {
                $mess[$file[$key]][] = "Image not uploaded!  " . $imagecopy_mess;
            }
            /* ************* */

            if ($type == 'jpeg') $type = 'jpg';
            switch ($type) {
                case 'bmp':
                    $img = imagebmp($img, $path_to_save . $file[$key]);
                    break;
                case 'gif':
                    $img = imagegif($img, $path_to_save . $file[$key]);
                    break;
                case 'jpg':
                    $img = imagejpeg($img, $path_to_save . $file[$key]);
                    break;
                case 'png':
                    $img = imagepng($img, $path_to_save . $file[$key]);
                    break;
                default :
                    return "Unsupported picture type!";
            }
            
            $obj_image_resize = new Lib_ImageResize();
            
            $small_mess = $obj_image_resize->image_resize($path_to_save . $file[$key], "images/small/$file[$key]", 100, 100, 1);
            if ($small_mess !== true) {
                $mess[$file[$key]][] = "Small picture not created!  " . $small_mess;
            }
            $medium_mess = $obj_image_resize->image_resize($path_to_save . $file[$key], "images/medium/$file[$key]", 200, 200, 1);
            if ($medium_mess !== true) {
                $mess[$file[$key]][] = "Medium picture not created!  " . $medium_mess;
            }
        }// endforeach
        return $mess;
    }

}

?>