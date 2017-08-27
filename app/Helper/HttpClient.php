<?php
namespace App\Helper;

class HttpClient
{
    public static function GET($url, $httpheaders = [], $verifySSL = false)
    {
        $webClient = curl_init();
        curl_setopt($webClient, CURLOPT_URL, $url);
        curl_setopt($webClient, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($webClient, CURLOPT_SSL_VERIFYPEER, false);
        if(count($httpheaders) > 0)
        {
            curl_setopt($webClient, CURLOPT_HTTPHEADER, $httpheaders);
        }
        
        $responseData = curl_exec($webClient);
        if(curl_errno($webClient)) {
            throw new \Exception(curl_error($webClient), curl_errno($webClient));
	    }
        curl_close($webClient);

        return $responseData;
    }
    
    public static function POST($url, $data, $httpheaders = [], $verifySSL = false)
    {
        $webClient = curl_init();
        curl_setopt($webClient, CURLOPT_URL, $url);
        curl_setopt($webClient, CURLOPT_POST, 1);
        curl_setopt($webClient, CURLOPT_POSTFIELDS, $data);
        curl_setopt($webClient, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($webClient, CURLOPT_SSL_VERIFYPEER, false);
        if(count($httpheaders) > 0)
        {
            curl_setopt($webClient, CURLOPT_HTTPHEADER, $httpheaders);
        }

        $responseData = curl_exec($webClient);
        if(curl_errno($webClient)) {
            throw new \Exception(curl_error($webClient), curl_errno($webClient));
	    }
        curl_close($webClient);

        return $responseData;
    }
}