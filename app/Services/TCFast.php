<?php

namespace App\Services;


use App\Libs\AddressHelper;

class TCFast extends AbstractTransportCompany
{

    public string $base_url = '';

    public function costCulculation($from, $to, $weight)
    {

        if (date('H') > 18) return json_encode([
            'error' => "После 18 заявки не принимаются"
        ]);

        return $this->response($this->getData($from, $to, $weight));

    }

    public function response($response)
    {

        $responseArr = json_decode($response);

        if (!empty($responseArr->error)) return $response;

        $responseArr->date = date('Y-m-d',mktime(date('H'),date('i'),1,date('m'),(date('d')+$responseArr->period)));

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

//        dd($cityFrom,$cityTo);

        $dist = self::culcDistance($cityFrom->latitude,$cityFrom->longitude, $cityTo->latitude,$cityTo->longitude);

        return json_encode([
            'price' => $dist*0.40*$weight,
            'period'  => ceil($dist/300),
            'error' => ''
        ]);
    }
}