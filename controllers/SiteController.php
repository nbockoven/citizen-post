<?php

namespace app\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\mongodb\Query;
use yii\web\Controller;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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
                'fixedVerifyCode' => YII_ENV_TEST ? 'testit' : null,
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
                ->orderBy(['date.uploaded' => SORT_DESC])
                ->limit( 20 )
                ->offset( $page - 1 );

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
                ->where(['<>', 'canonical', str_replace('/', '', Url::current())])
                ->orderBy(['date.uploaded' => SORT_DESC])
                ->limit(3);
        $trending = $query->all();

        return $this->render('view', ['article' => $article, 'trending' => $trending]);
    }
}
