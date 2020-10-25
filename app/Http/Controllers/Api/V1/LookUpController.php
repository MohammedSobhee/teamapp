<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CityEloquent;
use App\Repositories\Eloquents\CountryEloquent;
use App\Repositories\Eloquents\PositionEloquent;
use Illuminate\Http\Request;

class LookUpController extends Controller
{
    //
    protected $city, $country, $position;

    public function __construct(CityEloquent $cityEloquent, CountryEloquent $countryEloquent, PositionEloquent $positionEloquent)
    {
        $this->city = $cityEloquent;
        $this->country = $countryEloquent;
        $this->position = $positionEloquent;
    }

    public function lookUps()
    {
        $data = [
            'cities' => $this->city->getAll([]),
            'countries' => $this->country->getAll([]),
            'positions' => $this->position->getAll([]),
        ];

        return response_api(true, 200, null, $data);
    }
}
