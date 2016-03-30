<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29/03/16
 * Time: 14:10
 */

namespace app\Utils;


use App\AudioBook;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

class IABUtils
{

    const REFRESH_TOKEN = '1/kqxMBPnb12DvYzqCuuO5jtQkX3UIdniO2ts4VdCDvrQ';
    const CLIENT_ID = '628702338394-8efpb3vtcnn9pdh7iktnht0t5uifvvbp.apps.googleusercontent.com';
    const CLIENT_SECRET = '0hrqkLltUqzzqEnq3lc_wL19';

    const CACHE_IAB_ACCESS_TOKEN = 'iab_access_token';

    const PACKAGE_NAME = 'com.audiobuku';

    public function refreshAuthAsync()
    {
        $client = new Client();
        $body = [
            [
                'name' => 'grant_type',
                'contents' => 'refresh_token'
            ],
            [
                'name' => 'client_id',
                'contents' => self::CLIENT_ID
            ],
            [
                'name' => 'client_secret',
                'contents' => self::CLIENT_SECRET
            ],
            [
                'name' => 'refresh_token',
                'contents' => self::REFRESH_TOKEN
            ]
        ];

        $promise = $client->postAsync('https://accounts.google.com/o/oauth2/token', ['multipart' => $body]);
        $promise->then(
            function (ResponseInterface $res) {
                if ($res->getStatusCode() == 200) {
                    $token = json_decode($res->getBody())['token_type'];
                    Cache::put(self::CACHE_IAB_ACCESS_TOKEN, $token, 60);
                }
            },
            function (RequestException $e) {
            }
        );
    }

    public function refreshAuth()
    {
        $client = new Client();
        $body = [
            [
                'name' => 'grant_type',
                'contents' => 'refresh_token'
            ],
            [
                'name' => 'client_id',
                'contents' => self::CLIENT_ID
            ],
            [
                'name' => 'client_secret',
                'contents' => self::CLIENT_SECRET
            ],
            [
                'name' => 'refresh_token',
                'contents' => self::REFRESH_TOKEN
            ]
        ];

        $res = $client->post('https://accounts.google.com/o/oauth2/token', ['multipart' => $body]);
        if ($res->getStatusCode() == 200) {
            $token = json_decode($res->getBody())['token_type'];
            Cache::put(self::CACHE_IAB_ACCESS_TOKEN, $token, 60);
        }
    }

    public function getAccessToken()
    {
        if (!Cache::has(self::CACHE_IAB_ACCESS_TOKEN)) {
            $this->refreshAuth();
        }
        return Cache::get(self::CACHE_IAB_ACCESS_TOKEN);
    }

    public function createProduct(AudioBook $audioBook)
    {
        $client = new Client();
        $header = [
            'Authorization' => $this->getAccessToken()
        ];


        $json = $this->generateProductJson($audioBook);

        $promise = $client->postAsync('https://www.googleapis.com/androidpublisher/v2/applications/' . self::PACKAGE_NAME . '/inappproducts', [
            'headers' => $header,
            'json' => $json
        ]);
        $promise->then(
            function (ResponseInterface $res) {
            },
            function (RequestException $e) {
            }
        );
    }

    public function updateProduct(AudioBook $audioBook)
    {
        $client = new Client();
        $header = [
            'Authorization' => $this->getAccessToken()
        ];


        $json = $this->generateProductJson($audioBook);

        $promise = $client->putAsync('https://www.googleapis.com/androidpublisher/v2/applications/' . self::PACKAGE_NAME . '/inappproducts/' . $audioBook->id, [
            'headers' => $header,
            'json' => $json
        ]);
        $promise->then(
            function (ResponseInterface $res) {
            },
            function (RequestException $e) {
            }
        );
    }

    public function deleteProduct(AudioBook $audioBook)
    {
        $client = new Client();
        $header = [
            'Authorization' => $this->getAccessToken()
        ];

        $promise = $client->deleteAsync('https://www.googleapis.com/androidpublisher/v2/applications/' . self::PACKAGE_NAME . '/inappproducts/' . $audioBook->id, [
            'headers' => $header,
        ]);
        $promise->then(
            function (ResponseInterface $res) {
            },
            function (RequestException $e) {
            }
        );
    }

    private function generateProductJson(AudioBook $audioBook)
    {
        if ($audioBook->visibility == 1) {
            $status = 'active';
        } else {
            $status = 'inactive';
        }

        return [
            'packageName' => 'com.audiobuku',
            'sku' => $audioBook->id,
            'status' => $status,
            'purchaseType' => 'managedUser',
            'defaultPrice' => [
                'priceMicros' => number_format($audioBook->price / 1000000, 0, '.', ','),
                'currency' => 'IDR'
            ],
            'listings' => [
                'id-ID' => [
                    'title' => $audioBook->title,
                    'description' => $audioBook->about
                ]
            ],
            'defaultLanguage' => 'id-ID',
        ];
    }

}