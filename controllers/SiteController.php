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
    public $layout = 'main-eternal-listing';

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
        if( Yii::$app->request->isAjax ){
            $query = new Query();

            $keyword = ( isset( $keyword ) && is_string( $keyword ) ) ? trim( strip_tags( $keyword ) ) : '';

            $limit = 20;
            $offset = 0;

            // get results paginated
            $query->select( ['canonical', 'title', 'body', 'image'] )
                    ->from( 'articles' )
                    ->where( ['or', ['like', 'title', $keyword], ['like', 'body', $keyword]] )
                    ->orderBy( ['date.uploaded' => SORT_DESC] )
                    ->limit( $limit )
                    ->offset( $offset );

            return json_encode( $query->all() );
        }

        return $this->render('index');
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

        return $this->render('view', ['article' => $article]);
    }
}
