<?php

namespace app\commands;

use Yii;

use yii\console\Controller;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use yii\mongodb\Database;
use yii\mongodb\Query;
use Imagery\Imagery;

class ScrapeController extends Controller
{
    public $CLIENT;
    public $IMAGE_WIDTH  = 290; // px
    public $IMAGE_HEIGHT = 290; // px
    public $FAKENEWS = [
        "http://americannews.com",
    ];

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex( $page = 1 )
    {
        $collection = Yii::$app->mongodb->getCollection('articles');

        foreach( $this->FAKENEWS as $url ){
            // get fake news site page content
            $this->CLIENT = new Client([
                'base_uri' => $url,
                'timeout'  => 4.0,
                'headers'  => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
                ],
            ]);

            // set page number of results to scrape
            $page = ( intval( $page ) ) ? intval( $page ) : 1;

            for( ; $page >= 1; $page-- ){
                $articles = []; // array to save articles
                // request page
                $response = $this->CLIENT->request('GET', "/page/{$page}/");

                // create crawler instance from body HTML code
                $crawler = new Crawler( (string) $response->getBody() );

                // apply filter to grab articles
                $filter = $crawler->filter('article');

                if( iterator_count( $filter ) ){
                    // iterate over filter results
                    foreach( $filter as $content ){
                        $article = new Crawler( $content );

                        // extract the values needed
                        $referralURL = $article->filter('a')->attr('href');

                        if( strlen( $referralURL ) ){
                            $canonical = str_replace([$url, '/'], '', $referralURL);

                            // before continuing, check to see if this is a duplicate (already saved in db)
                            $query = new Query();
                            // compose the query
                            $query->select(['_id'])
                                    ->from('articles')
                                    ->where(['canonical' => $canonical]);

                            $numResults = $query->count();

                            if( !$numResults ){ // not found in db, so continue to get data to insert
                                $imageURL = $article->filter('img')->attr('src');

                                // get detail page content
                                $canonical   = str_replace([$url, '/'], '', $referralURL);
                                $response    = $this->CLIENT->request('GET', $canonical);
                                $articleBody = new Crawler( (string) $response->getBody() );
                                $articleBody = $articleBody->filter('.post-content > p');
                                $body        = '';
                                foreach( $articleBody as $b ){
                                    $text = trim( $b->textContent );
                                    if( strlen( $text ) )
                                        $body .= "<p>".$text."</p>";
                                }

                                $temp = [
                                    'original' => [
                                        'url'   => addslashes( $referralURL ),
                                        'image' => addslashes( $imageURL ),
                                    ],
                                    'canonical' => $canonical,
                                    'title' => addslashes( $article->filter('h2')->text() ),
                                    'body' => addslashes( $body ),
                                    'date' => [
                                        'uploaded' => time()
                                    ]
                                ];

                                // resize & save image to file system
                                $articles[] = $this->actionSaveArticleImage( $temp );
                            }
                        }
                    }
                }

                // add articles to mongodb
                if( $articles )
                    $collection->batchInsert( $articles );
            }
        }
    }


    public function actionSaveArticleImage( array $article ): array
    {
        $fileName = \Yii::$app->basePath."/web/images/articles/{$article['canonical']}";

        $tempImage = fopen($fileName.'.jpg', 'w') or die('Oh, crap! Couldn\'t open the image file');

        // request image
        $request = $this->CLIENT->request('GET', $article['original']['image'], ['sink' => $tempImage]);

        // fclose( $tempImage );

        // manipulate image
        // make to versions (small, large) for listing and detail views
        $images['large'] = Imagery::tryCreateFromFile( $fileName.'.jpg' );
        $images['small'] = $images['large'];

        foreach( $images as $size => $image ){
            switch( $size ){
                case 'large':
                    $width  = $this->IMAGE_WIDTH * 2;
                    $height = $this->IMAGE_HEIGHT * 2;
                    break;
                default:
                    $width  = $this->IMAGE_WIDTH;
                    $height = $this->IMAGE_HEIGHT;
            }
            // resize image to proper width
            $image->zoomWidthTo( $width );
            // determine if image needs cropped (too tall)
            if( $image->getHeight() > $height )
                $image->crop(0, 0, $width, $height);

            // save image
            $newFileName = $fileName.'_'.$size.'.jpg';
            $image->save( $newFileName, 'jpg', 85 );

            $article['image'][$size] = str_replace(\Yii::$app->basePath."/web/images/articles/", '', $newFileName);
        }

        unlink( $fileName.'.jpg' );

        return $article;
    }
}
