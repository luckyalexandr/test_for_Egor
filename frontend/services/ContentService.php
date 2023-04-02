<?php

namespace frontend\services;

use frontend\forms\ContentForm;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Response;

class ContentService
{
    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function request(ContentForm $form): Response
    {
        $str = '';
        foreach ($form as $k => $item) {
            $item ? $str .= $k . '=' . $this->parameter($item, $k) . '&' : $str .= '';
        }

        $properties = $form->property_id ? $this->properties($form->property_id) : 'properties';

        $url = '/' . $properties . '/content?' . substr($str,0,-1);

        $client = new Client(['baseUrl' => 'https://test.ean.com/v3']);
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setHeaders(['Accept' => $form->header->accept])
            ->addHeaders(['Authorization' => (new \frontend\helpers\ApiAuthHelper)->authApi()])
            ->addHeaders(['Accept-Encoding' => $form->header->accept_encoding])
            ->addHeaders(['User-Agent' => $form->header->user_agent])
            ->addHeaders(['User-Agent' => $form->header->customer_session_id])
            ->send();
        return $response;
    }

    private function properties($properties): string
    {
        $prefix = 'property_id';

        return $this->parameter($properties, $prefix);
    }

    private function parameter($item, $k): string
    {
        $array  = explode(',', $item);
        $string = '';
        foreach ($array as $i) {
            if (!next($array)) {
                $k == 'multi_unit' ? ($i == '0' ? $string .= 'false' : $string .= 'true') : $string .= $k . '=' . $i;
            } else {
                $k == 'multi_unit' ? ($i == '0' ? $string .= 'false' : $string .= 'true') : $string .= $k . '=' . $i . '&';
            }
        }
        return $string;
    }
}