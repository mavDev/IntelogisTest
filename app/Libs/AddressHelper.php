<?php

namespace App\Libs;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class AddressHelper
{

    static bool|Collection $cities = false;

    public static function getCities(): Collection
    {
        if ( self::$cities instanceof Collection) return  self::$cities;
        else self::$cities = collect(json_decode(File::get(database_path('addresses.json'))))->filter(fn($item)=>$item->population > 200000);
       return self::$cities;
    }

    public static function findCityById($id){
        return self::getCities()->where('id',$id)->first();
    }

}