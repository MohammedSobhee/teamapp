<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Positions\CreateRequest;
use App\Http\Requests\Admin\Positions\UpdateRequest;
use App\Repositories\Eloquents\PositionEloquent;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    //
    private $position;

    public function __construct(PositionEloquent $positionEloquent)
    {
        $this->position = $positionEloquent;
    }

    public function anyData()
    {
        return $this->position->anyData();
    }

    public function index()
    {
        return view(admin_positions_vw() . '.index');
    }

    public function create()
    {
        $view = view()->make(modals('positions.add'));

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->position->create($request->all());
    }

    public function edit($id)
    {
        $position = $this->position->getById($id);
        $view = view()->make(modals('positions.edit'), [
            'position' => $position
        ]);

        $html = $view->render();

        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->position->update($request->all(), $id);
    }

    public function changeStatus($id)
    {
        return $this->position->changeStatus($id);
    }

    public function delete($id)
    {
        return $this->position->delete($id);
    }
}
