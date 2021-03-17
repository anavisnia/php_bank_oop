<?php
namespace App;

class Helper {
    
    public static function getCurrency()
    {
        $currency1 = 'KRW';
        // $currency2 = '';
        //serverio  vidus
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL, API.$currency1);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        $answer = curl_exec($curl); // siunciame uzklausa, laukiame.... atsakyma irasome i $answer

        curl_close($curl);

        $answer = json_decode($answer);
        $currencyAnswer = $answer->rates->$currency1;
        // _pc($currencyAnswer);
        return $currencyAnswer;
    }
}