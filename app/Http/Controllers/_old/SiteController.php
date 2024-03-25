<?php

namespace app\controllers;

use app\models\Page;
use app\models\Post;
use Yii;
use app\components\Controller;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /*public function behaviors()
    {
        //return [];
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    } */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $page = Page::getSystemPage(Page::SYSTEM_PAGE_INDEX);
        $this->defaultPage($page);

        return $this->render('index', [
            'webpage' => $page
        ]);

    }


    public function actionPage($url)
    {

        if (($page = Page::find()->where(['url' => $url])->with('seo')->one()) !== null)
        {

            if ($page->system_page == Page::SYSTEM_PAGE_INDEX) {
                $this->redirect('/', 301);
            }
            $this->defaultPage($page);

            return $this->render('page', [
                'webpage' => $page
            ]);
        }
        else
        {
            throw new NotFoundHttpException('Страница не найдена.');
        }


    }



    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('accessAdminka'))
            {
                $this->redirect('/admin/');
            }
            else {
                return $this->goBack();
            }
        } else {

            $page = Page::getSystemPage(Page::SYSTEM_PAGE_LOGIN);
            $this->defaultPage($page);

            return $this->render('login', [
                'model' => $model,
                'webpage' => $page,
            ]);

        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }



    public function defaultPage($page)
    {

        parent::defaultPage($page);

        $key = null;

        foreach (['about', 'zhd', 'scheme', 'portfolio', 'contacts'] as $cur_key) {
            if (isset($this->view->params['topmenu'][$cur_key])) {
                $toppage = $this->view->params['topmenu'][$cur_key];
                if (isset($page->breadcrumbs[$toppage->id])) {
                    $key = $cur_key;
                }
            }
        }

        $this->view->params['topmenu_key'] = $key;
    }


    public function actionContact()
    {

        $model = new ContactForm();
        if ($errors = $this->performAjaxValidation($model)) {
            return $errors;
        }




        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');


        }
            $page = Page::getSystemPage(Page::SYSTEM_PAGE_CONTACTS);
            $this->defaultPage($page);

            return $this->render('contact', [
                'model' => $model,
                'webpage' => $page,
            ]);

    }

    protected function performAjaxValidation($model)
    {
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }

}
