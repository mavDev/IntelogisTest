<?php

namespace App\Http\Controllers;

use App\Libs\AddressHelper;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $cities = AddressHelper::getCities()->sortBy('name');

        $data = new \stdClass();
        if (session()->has('calc1')){
            $data->calcFast = json_decode(session()->get('calc1'));
        }
        if (session()->has('calc2')){
            $data->calcSlow = json_decode(session()->get('calc2'));
        }
        return \view('home',['cities'=>$cities, 'data' => $data]);
    }
}
