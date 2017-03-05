<?php
namespace app\controllers;
class UploadImage
{

    public static function upload($img)
    {
        //limit options of image file
        $img_config = require ROOT . '/config/config_img.php';
        $tmp_name = $img["tmp_name"];
        $ext = strtolower(pathinfo($img["name"], PATHINFO_EXTENSION));
//var_dump($img); exit;
        if ($img["size"]>0 && in_array($ext, $img_config['ext'])) {
            $newRandomName = self::getRandomFileName($img["name"],IMG);
            $pathNewImg = self::resizeImage($img["tmp_name"],$newRandomName);

                return $pathNewImg;
        }
        return "";
    }


    public static function getRandomFileName($fileName,$path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
        do {
            $rand = substr(md5(microtime() . rand(0, 9999)), 0, 20);
            $name = $rand."_".$fileName;
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $file;
    }

    public static function ratioCalculate($width,$height){
        //limit options of image file
        $img_config = require ROOT . '/config/config_img.php';

        $newW =$width;
        $newH =$height;

        if($width>$img_config['width']){
            $newW=$img_config['width'];
            $koef = ($width/$newW);
            $newH = ceil($height/$koef);
            //если при ширине картинки в 320 высота превышает лимит 240
            //нужно уменьшать относительно высоты
            if($newH>$img_config['height']){
                //тогда
                $newH = $img_config['height'];
                $koef = ($height/$newH);
                $newW = ceil($width/$koef);
            }
        }
        elseif ($height>$img_config['height'])
        {
                $newH = $img_config['height'];
                $koef = ($height/$newH);
                $newW = ceil($width/$koef);
        }

        return ['width'=>$newW, 'height'=>$newH];
    }

    /**
     * resize Image and store in $dstPath
     * if success returns $dstPath
     *
     * @param $srcImg resource
     * @param $dstPath string
     * @return string
     */
    public static function resizeImage($srcImg, $dstPath){

        $absDstPath =WWW . $dstPath;
//        var_dump($absDstPath); exit;
        list($width, $height, $image_type) = getimagesize($srcImg);

        $newSize = self::ratioCalculate($width,$height);
        //если размеры не больше лимитов
        //значит ресайзить не нужно возвращаем путь непосредственно к картинке

        $dstImg = imagecreatetruecolor($newSize['width'], $newSize['height']);

        switch ($image_type)
        {
            case 1: $source = imagecreatefromgif($srcImg); break;
            case 2: $source = imagecreatefromjpeg($srcImg);  break;
            case 3: $source = imagecreatefrompng($srcImg); break;
            default: return '';  break;
        }

        imagecopyresized($dstImg, $source, 0, 0, 0, 0, $newSize['width'], $newSize['height'], $width, $height);

        switch ($image_type)
        {
            case 1: imagegif($dstImg,$absDstPath); break;
            case 2: imagejpeg($dstImg, $absDstPath, 100);  break; // best quality
            case 3: imagepng($dstImg, $absDstPath, 0); break; // no compression
            default: echo ''; break;
        }
        return $dstPath;
    }
}