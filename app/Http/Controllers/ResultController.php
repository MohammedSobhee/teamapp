<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Results\CreateRequest;
use App\Http\Requests\Admin\Results\UpdateRequest;
use App\Repositories\Eloquents\ResultEloquent;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //

    private $result;

    public function __construct(ResultEloquent $resultEloquent)
    {
        $this->result = $resultEloquent;
    }

    public function anyData()
    {
        return $this->result->anyData();
    }

    public function index()
    {
        return view(admin_results_vw() . '.index');
    }

    public function create()
    {
        $view = view()->make(modals('results.add'));

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->result->create($request->all());
    }

    public function edit($id)
    {
        $result = $this->result->getById($id);
        $view = view()->make(modals('results.edit'), [
            'results' => $result
        ]);

        $html = $view->render();

        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->result->update($request->all(), $id);
    }

    public function changeStatus($id)
    {
        return $this->result->changeStatus($id);
    }

    public function delete($id)
    {
        return $this->result->delete($id);
    }
}
