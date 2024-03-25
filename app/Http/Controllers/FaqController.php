<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Faq;
use app\models\Portfolio;
use app\models\Page;
use app\models\PortfolioSection;
use yii\web\NotFoundHttpException;

class FaqController extends Controller
{
    public function actionIndex()
    {

        $page = Page::getSystemPage(Page::SYSTEM_PAGE_FAQ);

        $this->defaultPage($page);

        $faq = Faq::published();

        return $this->render('index', [
            'webpage' => $page,
            'faq' => $faq,
        ]);
    }


    public function actionView($url)
    {
        if (($faq_page = Faq::find()->where(['url' => $url, 'status' => Faq::STATUS_ACTIVE])->one()) !== null) {

            $this->defaultPage($faq_page);

            $faq = Faq::published();

            return $this->render('view', [
                'faq_page' => $faq_page,
                'faq' => $faq,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

