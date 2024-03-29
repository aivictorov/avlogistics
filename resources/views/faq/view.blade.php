
<section class="main-section main-section__container--page">
    <div class="main-section__container main-section__container--aside">
        <div class="aside-page">
            <?= $this->render('@app/views/layouts/parts/breadcrumbs', ['breadcrumbs'=>  $webpage->breadcrumbs, 'devider' => '/']) ?>
            <h1 class="page-h1"><?= Html::encode($webpage->h1) ?></h1>



            <div class="page-content">
                <?= $webpage->announce ?>

                <div class="faq-page-questions">
                    <?php foreach($faq_page->questions as $question): ?>
                        <div class="faq-page-questions_item">
                            <a class="faq-anchor" name="<?= \app\components\Translit::urlTranslit($question->name) ?>"></a>
                            <h2>
                                <?= $question->name ?>
                            </h2>
                            <blockquote>
                                <?= $question->answer; ?>
                            </blockquote>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>


        </div>


        <?= $this->render('parts/aside', ['faq_sections' => $faq]) ?>

    </div>



</section>
