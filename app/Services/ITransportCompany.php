<?php

namespace App\Services;

interface ITransportCompany
{

   public function costCulculation($from,$to,$weight);

   public function getData($from,$to,$weight);

   public function response($response);

}