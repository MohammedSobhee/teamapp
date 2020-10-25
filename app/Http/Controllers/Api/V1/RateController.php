<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\RatesEloquent;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    private $rate;

    public function __construct(RatesEloquent $ratesEloquent)
    {
        $this->rate = $ratesEloquent;
    }

    public function addPlayerRates(Request $request)
    {
        return $this->rate->addPlayerRates($request->all());
    }
}
