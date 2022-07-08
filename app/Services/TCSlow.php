<?php

namespace App\Services;


use App\Libs\AddressHelper;

class TCSlow extends AbstractTransportCompany
{

    public static $dase_price = 150;
    public string $base_url = '';

    public function costCulculation($from, $to, $weight)
    {

        return $this->response($this->getData($from, $to, $weight));

    }

    public function response($response)
    {

        $responseArr = json_decode($response);

        if (!empty($responseArr->error)) {
            return $response;
        }

        $responseArr->price = $responseArr->coefficient * self::$dase_price;

        return json_encode([
            "price" => round($responseArr->price),
            "date" => $responseArr->date,
            "error" => ""
        ]);

    }

    public function getData($from, $to, $weight)
    {
        $cityFrom = AddressHelper::findCityById($from);
        $cityTo = AddressHelper::findCityById($to);

        $dist = self::culcDistance($cityFrom->latitude, $cityFrom->longitude, $cityTo->latitude, $cityTo->longitude);

        $coefficient = $dist / 600;
        $period = ceil($dist / 150);

        return json_encode([
            'coefficient' => $coefficient*$weight,
            'date' => date('Y-m-d', mktime(date('H'), date('i'), 1, date('m'), (date('d') + $period))),
            'error' => ''
        ]);
    }
}