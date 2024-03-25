<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 13.02.15
 * Time: 5:08
 */

namespace app\models\images;


use shvedovka\imageuploader\Image;

class ImagePortfolioAvatar extends Image {

    const parent_type = 'portfolio_avatar';
    var $default_size = 'page_';


    public function getThumbSizes()
    {
        return [
            'big_' => [670, 350, true],
            'page_' => [500, 260, true],
            'header_' => [265, 168],
            'small_' => [152, 80],
        ];
    }


}