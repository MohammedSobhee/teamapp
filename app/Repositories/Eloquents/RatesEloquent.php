<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\PlayerRate;
use App\PlayerStats;
use App\Repositories\Interfaces\Repository;
use App\Stats;

class RatesEloquent implements Repository
{

    private $model;

    public function __construct(PlayerRate $model)
    {
        $this->model = $model;

    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    function getById($id)
    {
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
    }

    function addPlayerRates(array $attributes)
    {
        // TODO: Implement delete() method.
        $rates = new PlayerRate();
        $rates->rate_type_id = $attributes['rate_type_id'];
        $rates->player_id = $attributes['player_id'];
        $rates->team_id = $attributes['team_id'];
        $rates->match_id = $attributes['match_id'];
        $rates->rate = $attributes['rate'];
        $rates->save();
        return response_api(true, 200, null, []);

    }

}
