<?php
namespace App\Utils;
use Imagick;
class SvgToPng{

    private  $svgfile = '';
    private  $format = '';
    /**
     * Constructor
     *
     * @param $data     Data to save
     */
    public function __construct($src='', $format = "png")
    {
        $this->svgfile = $src;
        $this->format = $format;
    }


    /**
     * Set SVG file
     *
     * @param string local path or URL of SVG file
     */
    public function set_svgfile($src='') {
        $this->svgfile = $src;
	}


    /**
     * imagecreatefromsvg - Create new image from file or URL
     *
     * @return resource GD image resource or FALSE
     */
    public function image() {

        return $this->imagecreatefromsvg($this->svgfile);

	}

    /**
    * imagecreatefromsvg - Create new image from file or URL
    *
    * @param string $filename
    * @return resource or FALSE
    * @author ukj@ukj.pri.ee ; http://ukj.pri.ee
    * @version 0.9b
    */
    private function imagecreatefromsvg( $source ) {

        if( function_exists('sys_get_temp_dir')) {
            $tmpdir = sys_get_temp_dir();
            }
        elseif( is_dir( '/tmp')) {
            $tmpdir = '/tmp/';
            }
        elseif( is_dir( 'C:\\windows\\tmp')) {
            $tmpdir = 'C:\\windows\\tmp\\';
            }
        if(file_exists($source)){
            $svg_str = file_get_contents( $source );
        } else {
            $svg_str = $source;
        }

        if( $svg_str === FALSE ) return FALSE;
        else {

            $tmpf_img = tempnam( $tmpdir , 'icftmp_' );
            $im = new Imagick();
            $im->readImageBlob($svg_str);

            /*png settings*/
            if ($this->format == 'jpeg'){
                $im->setImageFormat("jpeg");
            } else {
                $im->setImageFormat("png24");
            }

            //$im->resizeImage(720, 445, Imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/
            $im->writeImage($tmpf_img);/*(or .jpg)*/
            $im->clear();
            $im->destroy();

        }
        if ($this->format == 'jpeg'){
            $tmpf_img_rc = imagecreatefromjpeg( $tmpf_img );
        } else {
            $tmpf_img_rc = imagecreatefrompng( $tmpf_img );
               // Turn off alpha blending and set alpha flag
            imagealphablending($tmpf_img_rc, false);
            imagesavealpha($tmpf_img_rc, true);
        }
        ob_start(); // Let's start output buffering.
        imagepng($tmpf_img_rc); //This will normally output the image, but because of ob_start(), it won't.
        $contents = ob_get_contents(); //Instead, output above is saved to $contents
        ob_end_clean(); //End the output buffer.


       // echo( $tmpf_img );
        unlink( $tmpf_img );

        return $contents;


	}


}/*class*/


