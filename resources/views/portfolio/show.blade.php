<?php

use yii\helpers\Html;
use app\widgets\BreadcrumbsWidget;
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 19.02.15
 * Time: 5:57
 */
?>
<section class="main-section main-section__container--page">
    <div class="main-section__container main-section__container--aside">
        <article class="aside-page">
            <?= $this->render('@app/views/layouts/parts/breadcrumbs', ['breadcrumbs'=>  $portfolio->breadcrumbs, 'devider' => '/']) ?>
            <h1 class="page-h1"><?= Html::encode($portfolio->h1) ?></h1>

            <?php $images = array_merge([$portfolio->avatar],$portfolio->images); ?>
            <div class="js-portfoio-gallerey">
                <div class="portfolio-gallerey">
                    <div class="portfolio-gallerey-in">
                        <?php foreach($images as $image): ?>
                            <img src="<?= $image->getUrl("big_") ?>" class="portfolio-gallerey-bigimage"/>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($images) > 1): ?>
                        <span class="portfolio-gallerey-arrow portfolio-gallerey-arrow__left js-portfolio-gallerey-arrow__left"></span>
                        <span class="portfolio-gallerey-arrow portfolio-gallerey-arrow__right js-portfolio-gallerey-arrow__right"></span>
                    <?php endif; ?>
                </div>
                <?php if (count($images) > 1): ?>
                    <div class="portfolio-miniimages">
                        <?php foreach($images as $image): ?>
                            <img src="<?= $image->getUrl("small_") ?>" class="portfolio-gallerey-miniimage js-miniimage" />
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="page-content">
                <?= $portfolio->text ?>
            </div>
        </article>

        <?= $this->render('parts/aside', ['portfolio_sections' => \app\models\PortfolioSection::asidelist()]) ?>

    </div>



</section>