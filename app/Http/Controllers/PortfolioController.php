<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Portfolio;
use app\models\Page;
use app\models\PortfolioSection;
use yii\web\NotFoundHttpException;

class PortfolioController extends Controller
{
    public function actionIndex()
    {

        $page = Page::getSystemPage(Page::SYSTEM_PAGE_PORTFOLIO);

        $this->defaultPage($page);

        $portfolo_sections = PortfolioSection::find()->where(['status' => Portfolio::STATUS_ACTIVE])->with('portfolios')->orderBy('sort_key ASC, create_date DESC')->all();

        return $this->render('index', [
            'webpage' => $page,
            'portfolo_sections' => $portfolo_sections,
        ]);
    }

    public function actionView($url)
    {
        if (($portfolio = Portfolio::find()->where(['url' => $url, 'status' => Portfolio::STATUS_ACTIVE])->one()) !== null) {

            $this->defaultPage($portfolio);


            return $this->render('view', [
                'portfolio' => $portfolio,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

