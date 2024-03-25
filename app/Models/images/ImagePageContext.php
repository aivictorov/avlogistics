<?php

namespace app\models\images;


use shvedovka\imageuploader\Image;

class ImagePageContext extends Image {

    const parent_type = 'pagecontext_image';

    var $default_size = 'page_';



    public function getThumbSizes()
    {
        return [
            //'blog_' => [660, 200],
            //'list_' => [296, 400, false],
            'page_' => [670, 430, true],
            //'icon_' => [160, 120, false],

        ];
    }


}