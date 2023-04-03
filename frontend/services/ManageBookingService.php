<?php

namespace frontend\services;

use frontend\forms\ManageBookingForm;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Response;

class ManageBookingService
{
    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function request(ManageBookingForm $form): Response
    {
        $url = '/itineraries/' . $form->itinerary_id;

        $client = new Client(['baseUrl' => 'https://test.ean.com/v3']);
        $response = $client->createRequest()
            ->setMethod('DELETE')
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