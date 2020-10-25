<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Stats\CreateRequest;
use App\Http\Requests\Admin\Stats\UpdateRequest;
use App\Repositories\Eloquents\StatsEloquent;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    //
    private $stats;

    public function __construct(StatsEloquent $statsEloquent)
    {
        $this->stats = $statsEloquent;
    }

    public function anyData()
    {
        return $this->stats->anyData();
    }

    public function index()
    {
        return view(admin_stats_vw() . '.index');
    }

    public function create()
    {
        $view = view()->make(modals('stats.add'));

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->stats->create($request->all());
    }

    public function edit($id)
    {
        $stats = $this->stats->getById($id);
        $view = view()->make(modals('stats.edit'), [
            'stats' => $stats
        ]);

        $html = $view->render();

        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->stats->update($request->all(), $id);
    }

    public function changeStatus($id)
    {
        return $this->stats->changeStatus($id);
    }

    public function delete($id)
    {
        return $this->stats->delete($id);
    }
}
