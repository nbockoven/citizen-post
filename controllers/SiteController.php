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
    public function actionIndex( $page = null, $keyword = null )
    {
        // get current page number
        $pagination['current'] = ( intval( $page ) ) ? intval( $page ) : 1;
        // set prev and next pages
        $pagination['prev'] = $pagination['current'] - 1;
        $pagination['next'] = $pagination['current'] + 1;

        // set query limit and offset
        $limit  = 20;
        $offset = $limit * $pagination['prev'];

        $query = new Query();

        $keyword = ( isset( $keyword ) && is_string( $keyword ) ) ? trim( strip_tags( $keyword ) ) : '';

        // get total number of results
        $query->select( ['canonical', 'title', 'image'] )
                ->from( 'articles' )
                ->where( ['or', ['like', 'title', $keyword], ['like', 'body', $keyword]] );

        $pagination['total']['results'] = $query->count();

        $pagination['total']['pages'] = ceil( $pagination['total']['results'] / $limit );

        // determine if pagination should be shown
        $pagination['show'] = $pagination['current'] < $pagination['total']['pages'];

        // get results paginated
        $query->select( ['canonical', 'title', 'image'] )
                ->from( 'articles' )
                ->where( ['or', ['like', 'title', $keyword], ['like', 'body', $keyword]] )
                ->orderBy( ['date.uploaded' => SORT_DESC] )
                ->limit( $limit )
                ->offset( $offset );

        $articles = $query->all();

        return $this->render('index', ['articles' => $articles, 'pagination' => $pagination]);
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
