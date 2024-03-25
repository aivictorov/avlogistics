<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Page;
use app\models\Post;
use app\models\PostSection;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class PostController extends Controller
{
    public function actionIndex($section = null)
    {

        $pageSize = 10;

        $page = Page::getSystemPage(Page::SYSTEM_PAGE_BLOG);

        $this->defaultPage($page);


        $query = Post::find();
        $query->andFilterWhere([
            'status' => Page::STATUS_ACTIVE,
        ]);
        $query->orderBy('date DESC');

        if ($section)
        {
            $query->andFilterWhere([
                'post_section_id' => $section,
            ]);

            $post_section = PostSection::findOne($section);
            $page->crumb = [
                'url' => Html::a($post_section->name, ['post/section', 'section' => $post_section->id]),
                'name' => $post_section->name,
            ];
        }

        $postprovider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        $postprovider->setSort([
            'attributes' => [
                'id',
                'name',
            ]
        ]);


        $pangination = $postprovider->getPagination();

        $pangination->defaultPageSize = $pageSize;

        return $this->render('index', [
            'webpage' => $page,
            'postlist' => $postprovider->getModels(),
            'pages' => $postprovider->getPagination(),
        ]);
    }

    public function actionView($url)
    {

        if (($page = Post::find()->where(['url' => $url, 'status' => 1])->with('seo')->one()) !== null)
        {

            $this->defaultPage($page);

            return $this->render('view', [
                'webpage' => $page
            ]);
        }
        else
        {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }

}
