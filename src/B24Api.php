<?php

namespace ASCMedia\SimpleSiteBuilder;

use Exception;

class B24Api
{
    public function postLeadToB24(string $url, array $fields): void
    {
        $queryUrl = $url;
        $queryData = http_build_query([
            'fields' => $fields,
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $queryUrl,
            CURLOPT_POSTFIELDS => $queryData,
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);
        if (array_key_exists('error', $result)) {
            throw new Exception("Error Processing Request to B24", 1);
        }
    }
}
