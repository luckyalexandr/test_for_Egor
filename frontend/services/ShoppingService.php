<?php

namespace frontend\services;

use frontend\forms\ShoppingForm;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Response;

class ShoppingService
{
    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function request(ShoppingForm $form): Response
    {
        $str = '';
        foreach ($form as $k => $item) {
            $item ? $str .= $k . '=' . $item . '&' : $str .= '';
        }

        $url = '/notifications?' . substr($str,0,-1);

        $client = new Client(['baseUrl' => 'https://test.ean.com/v3']);
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setHeaders(['Accept' => 'application/json'])
            ->addHeaders(['Authorization' => (new \frontend\helpers\ApiAuthHelper)->authApi()])
            ->send();
        return $response;
    }
}