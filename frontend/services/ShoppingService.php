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
        $url = '/properties/' . $form->property_id . '/rooms/' . $form->room_id . '/rates/' . $form->rate_id;

        $client = new Client(['baseUrl' => 'https://test.ean.com/v3']);
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->addHeaders(['Authorization' => (new \frontend\helpers\ApiAuthHelper)->authApi()])
            ->setHeaders(['Accept' => $form->header->accept])
            ->setHeaders(['Accept-Encoding' => $form->header->accept_encoding])
            ->setHeaders(['Customer-Ip' => $form->header->customer_ip])
            ->setHeaders(['Customer-Session-Id' => $form->header->customer_session_id])
            ->setHeaders(['User-Agent' => $form->header->user_agent])
            ->send();
        return $response;
    }
}