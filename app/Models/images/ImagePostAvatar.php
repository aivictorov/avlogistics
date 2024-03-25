<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 13.02.15
 * Time: 5:08
 */

namespace app\models\images;


use shvedovka\imageuploader\Image;

class ImagePostAvatar extends Image {

    const parent_type = 'post_avatar';
    var $default_size = 'page_';


    public function getThumbSizes()
    {
        return [
            'page_' => [670, 270, true],
            //'blog_' => [660, 200],
            'small_' => [150, 80],
        ];
    }


}