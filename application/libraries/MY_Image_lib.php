<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class MY_Image_lib extends CI_Image_Lib {

function image_create_gd($path = '', $image_type = '')
{
    if ($path == '')
        $path = $this->full_src_path;

    if ($image_type == '')
        $image_type = $this->image_type;


    switch ($image_type)
    {
        case     1 :
                    if ( ! function_exists('imagecreatefromgif'))
                    {
                        $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_gif_not_supported'));
                        return FALSE;
                    }

                    return @imagecreatefromgif($path);
            break;
        case 2 :
                    if ( ! function_exists('imagecreatefromjpeg'))
                    {
                        $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_jpg_not_supported'));
                        return FALSE;
                    }

                    return @imagecreatefromjpeg($path);
            break;
        case 3 :
                    if ( ! function_exists('imagecreatefrompng'))
                    {
                        $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_png_not_supported'));
                        return FALSE;
                    }

                    return @imagecreatefrompng($path);
            break;

    }

    $this->set_error(array('imglib_unsupported_imagecreate'));
    return FALSE;
}

}