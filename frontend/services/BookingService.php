<?php

namespace frontend\services;

use frontend\forms\BookingForm;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Response;

class BookingService
{
    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function request(BookingForm $form): Response
    {
        $str = '';
        foreach ($form as $k => $item) {
            $item ? $str .= $k . '=' . $item . '&' : $str .= '';
        }

        $url = '/notifications?' . substr($str,0,-1);

        $client = new Client(['baseUrl' => 'https://test.ean.com/v3']);
        $response = $client->createRequest()
            ->setMethod('PUT')
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