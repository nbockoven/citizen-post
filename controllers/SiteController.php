<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class SiteController extends Controller
{
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
    public function actionIndex()
    {
        $articles = []; // array to save articles
        $internalErrors = libxml_use_internal_errors(true);

        $numPages = 5;
        for( $i = 1; $i <= $numPages; $i++ ){
            // get fake news site page content
            $client = new Client([
                'base_uri' => "http://americannews.com",
                'timeout'  => 2.0,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
                ],
            ]);

            // echo "<pre>";
            // var_dump( $client );
            // echo "</pre>";
            // die();

            $response = $client->request('GET', "/page/{$i}/");

            // create crawler instance from body HTML code
            $crawler = new Crawler( (string) $response->getBody() );

            // apply filter to grab articles
            $filter = $crawler->filter('article');

            if( iterator_count( $filter ) ){
                // iterate over filter results
                foreach( $filter as $content ){
                    $crawler = new Crawler( $content );
                    // extract the values needed
                    $articles[] = [
                        'referralURL' => addslashes( $crawler->filter('a')->attr('href') ),
                        'title'       => addslashes( $crawler->filter('h2')->text() ),
                        'image'       => addslashes( $crawler->filter('img')->attr('src') ),
                    ];
                }
            }
        }

        return $this->render('index', ['articles' => $articles]);
    }


    /**
     * Displays detail view page
     *
     * @return string
     */
    public function actionView()
    {
        // get content from db
        $page = 'db';
        $this->render('view', ['model' => $model]);
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
