<?php

namespace frontend\helpers;

class ApiAuthHelper
{
    public function authApi(): string
    {
        $apiKey = "abcdefg";
        $secret = "1a2bc3";
        $timestamp = time();
        $authHeader = 'EAN APIKey=' . $apiKey . ', Signature=' . hash("sha512", $apiKey.$secret.$timestamp) . ', timestamp=' . time();
        return $authHeader;
    }
}