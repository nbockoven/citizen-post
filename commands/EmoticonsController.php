<?php

namespace app\commands;

use Yii;

use yii\console\Controller;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Imagery\Imagery;

class EmoticonsController extends Controller
{
    public $CLIENT;
    public $SITES = [
        "http://emoticoner.com/" => [
            [
                'page'     => 'crazy-rabbit',
                'name'     => 'rabbit',
                'numPages' => 0, // zero indexed
            ],
            [
                'page'     => 'raccoon',
                'name'     => 'raccoon',
                'numPages' => 1,
            ],
            [
                'page'     => 'cheetah',
                'name'     => 'cheetah',
                'numPages' => 0,
            ],
            [
                'page'     => 'pink-mouse',
                'name'     => 'mouse',
                'numPages' => 1,
            ],
            [
                'page'     => 'red-crab',
                'name'     => 'crab',
                'numPages' => 0,
            ],
            [
                'page'     => 'eggy',
                'name'     => 'eggy',
                'numPages' => 0,
            ],
            [
                'page'     => 'leaf',
                'name'     => 'leaf',
                'numPages' => 0,
            ],
            [
                'page'     => 'pink-cat',
                'name'     => 'cat',
                'numPages' => 0,
            ],
        ],
    ];

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex( $page = 1 )
    {
        foreach( $this->SITES as $url => $subPages ){
            // get fake news site page content
            $this->CLIENT = new Client([
                'base_uri' => $url,
                'timeout'  => 4.0,
                'headers'  => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
                ],
            ]);

            foreach( $subPages as $page ){
                for( $i = 0; $i <= $page['numPages']; $i++ ){
                    // request page
                    $response = $this->CLIENT->request('GET', "/emoticons/{$page['page']}?page={$i}");

                    $crawler = new Crawler( (string) $response->getBody() );

                    $filter = $crawler->filter('ul.itemsList > li > img');

                    if( iterator_count( $filter ) ){
                        foreach( $filter as $content ){
                            $image            = new Crawler( $content );
                            $page['imageURL'] = $image->attr('src');
                            if( strlen( $page['imageURL'] ) )
                                $this->actionSaveImage( $page );
                        }
                    }
                }
            }
        }
    }


    public function actionSaveImage( $page ){
        $fileLocation = "/home/nbockoven/Downloads/emoticons/";
        $fileName     = explode('?', $page['imageURL']);

        // keep clean url to fetch image
        $requestURL = $fileName[0];

        $fileName = array_filter( explode('/', $requestURL) );
        $fileName = array_pop( $fileName );
        $fileName = trim( str_replace( [$page['page'], 'emoticon'], '', $fileName ) );
        $fileName = array_filter( explode('-', $fileName) );

        $temp = '';
        foreach( $fileName as $name )
            $temp .= ucfirst( $name );

        $fileLocation .= $page['name'] . $temp;

        if( !file_exists( $fileLocation ) ){
            $localImage = fopen($fileLocation, 'w') or die('Oh, crap! Couldn\'t open the image file.');
            $request = $this->CLIENT->request('GET', $requestURL, ['sink' => $localImage]);
        }
    }
}
