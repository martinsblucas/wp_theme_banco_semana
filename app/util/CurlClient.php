<?php


namespace App\Util;

use \Exception;


class CurlClient
{



    private function curl($url, $body, $header = [], $timeout = 0, $type = 'POST')
    {

        $ch       = curl_init();
        $header[] = 'Content-Type:application/json';
        $statusOK = array(200, 201);
        curl_setopt($ch, CURLOPT_URL, $url); //Url together with parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); //Timeout after 7 seconds
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        if ($body != null) {
            $body = json_encode($body);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        $data = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo $http_status;
        if (in_array($http_status, $statusOK)) {
            curl_close($ch);
            return json_decode($data);
        }
        $erro = $data;
        $erro = is_string($erro)? $erro : 'erro ';

        throw new Exception($erro);
    }

    public function get($url, $header = [], $timeout = 0)
    {
        return $this->curl($url, null, $header, $timeout,  'GET');
    }

    public function post($url, $body, $header = [], $timeout = 0)
    {
        return $this->curl($url, $body, $header, $timeout);
    }

    public function patch($url, $body, $header = [], $timeout = 0)
    {
        return $this->curl($url, $body, $header, $timeout,  'PATCH');
    }
}
