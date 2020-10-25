<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\City;
use App\Repositories\Interfaces\Repository;

class CityEloquent implements Repository
{

    private $model;

    public function __construct(City $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {

    }

    function export()
    {


    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return  $this->model->all() ;
    }

    function getById($id)
    {
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $city = $this->model->find($id);
            if (isset($city))
                return response_api(true, 200, null, $city);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

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
}
