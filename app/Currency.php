<?php
namespace App;

class Currency {

    public static function getCurrency()
    {
        $cache = Json::getDB()->readData('currency');
        $cacheTime = $cache->time;
        // scenarijus skaitymas is API
        if ($cacheTime < time()-TIME) {
            // cache pasenes
            $curl=curl_init();
            curl_setopt($curl, CURLOPT_URL, API);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            $answer = curl_exec($curl); // siunciame uzklausa, laukiame.... atsakyma irasome i $answer
            curl_close($curl);
            $answer = json_decode($answer);
            $answerArr = ['time' => time(),'data' => $answer];
            // file_put_contents(DIR.'data/currency.json',
            //     json_encode([
            //         'time' => time(), 
            //         'data' => $answer
            //     ])
            // );
            Json::getDB()->writeData($answerArr, 'currency');
        }
        // scenarijus skaitymas is cache
        else {
            $answer = Json::getDB()->readData('currency');
        }
    }
}