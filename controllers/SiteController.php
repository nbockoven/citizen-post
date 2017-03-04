<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\ContactForm;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

use yii\mongodb\Query;

class SiteController extends Controller
{
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex( $page = null )
    {
        $page = ( intval( $page ) ) ? intval( $page ) : 1;

        // $result = Yii::$app->mongodb->createCommand(['count' => 'restaurants'])->execute();

        // $collection = Yii::$app->mongodb->getCollection('articles');

        $query = new Query();
        // compose the query
        $query->select(['canonical', 'title', 'image.small'])
                ->from('articles')
                ->limit( 10 )
                ->offset( 0 )
                ->orderBy(['date.uploaded' => SORT_DESC]);

        $articles = $query->all();

        return $this->render('index', ['articles' => $articles]);
    }


    /**
     * Displays detail view page
     *
     * @return string
     */
    public function actionView()
    {
        // get article
        $query = new Query();
        $query->select(['canonical', 'title', 'body', 'image.large'])
                ->from('articles')
                ->where(['canonical' => str_replace('/', '', Url::current())]);
        $article = $query->one();

        // get trending articles
        $query = new Query();
        $query->select(['canonical', 'title', 'image.small'])
                ->from('articles')
                ->limit(3)
                ->where(['<>', 'canonical', str_replace('/', '', Url::current())]);
        $trending = $query->all();

        return $this->render('view', ['article' => $article, 'trending' => $trending]);
    }


    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
