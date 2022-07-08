<?php

namespace App\Http\Controllers;

use App\Services\TCFast;
use App\Services\TCSlow;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    //
    public function __invoke()
    {
        $data = \request()->validate([
            'inputFrom' => 'required|int',
            'inputTo' => 'required|int',
            'packageWeight' => 'required|int'
        ],
        [
            'inputFrom.required' => "Не указан пункт отправления",
            'inputFrom.int' => "Неверное значение",
            'inputTo.required' => "Не указан пункт назначения",
            'inputTo.int' => "Неверное значение",
            'packageWeight.int' => "Неверное значение"
            ]
        );

        $calc1 = (new TCFast())->costCulculation($data['inputFrom'],$data['inputTo'],$data['packageWeight']);
        $calc2 = (new TCSlow())->costCulculation($data['inputFrom'],$data['inputTo'],$data['packageWeight']);

        return back()->withInput()->with([
            'calc1' => $calc1,
            'calc2' => $calc2,
        ]);
    }
}
