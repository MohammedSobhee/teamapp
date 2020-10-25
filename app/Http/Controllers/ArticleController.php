<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Articles\CreateRequest;
use App\Http\Requests\Admin\Articles\UpdateRequest;
use App\Repositories\Eloquents\ArticleEloquent;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    private $article;

    public function __construct(ArticleEloquent $articleEloquent)
    {
        $this->article = $articleEloquent;
    }

    public function anyData()
    {
        return $this->article->anyData();
    }
    public function index()
    {
        return view(admin_articles_vw() . '.index');

    }


    public function create()
    {
        $view = view()->make(modals('articles.add'));

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->article->create($request->all());
    }

    public function edit($id)
    {
        $article = $this->article->getById($id);
        $view = view()->make(modals('articles.edit'), [
            'post' => $article
        ]);

        $html = $view->render();

        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->article->update($request->all(), $id);
    }

    public function changeStatus($id)
    {
        return $this->article->changeStatus($id);
    }

    public function delete($id)
    {
        return $this->article->delete($id);
    }
//    public function add()
//    {
//        return view(admin_articles_vw() . '.add');
//
//    }
}
