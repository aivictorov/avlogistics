<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 13.02.15
 * Time: 5:08
 */

namespace app\models\images;


use shvedovka\imageuploader\Image;

class ImagePortfolioImage extends Image {

    const parent_type = 'portfolio_image';
    var $default_size = 'small_';



    public function getThumbSizes()
    {
        return [
            'big_' => [670, 350, true],
            'small_' => [152, 80],
        ];
    }

}