<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Pitch\GetRequest;
use App\Repositories\Eloquents\PitchEloquent;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    //
    private $pitch;

    public function __construct(PitchEloquent $pitchEloquent)
    {
        $this->pitch = $pitchEloquent;
    }

    public function getPitches(GetRequest $request)
    {
        return $this->pitch->getAll($request->all());
    }

    public function getPitch($id)
    {
        return $this->pitch->getById($id);
    }

}
