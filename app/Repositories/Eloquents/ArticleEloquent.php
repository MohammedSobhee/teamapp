<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Post;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class ArticleEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $posts = $this->model->orderByDesc('created_at');
        return datatables()->of($posts)
            ->filter(function ($query) {
                $search = request()->get('query')['articles_table_search'];

                if (isset($search)) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                }


            })->editColumn('media', function ($post) {
                if ($post->media_type == 'image') {
                    return '<img src="' . $post->media100 . '" class="img-circle">';
                }
                return '<a href="' . $post->media . '" target="_blank">رابط الفيديو</a>';
            })->editColumn('is_active', function ($post) {

                $checked = ($post->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $post->is_active . '" data-link="' . url(admin_articles_url() . '/posts/' . $post->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($stat) {
                return '<a href="' . url(admin_articles_url() . '/' . $stat->id . '/edit') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit-post-mdl" title="تعديل"><i class="la la-edit"></i></a>
                        <a href="' . url(admin_articles_url() . '/' . $stat->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete" title="حذف"><i class="la la-trash"></i></a>
                    ';
            })->addIndexColumn()
            ->rawColumns(['media', 'is_active', 'action'])->toJson();
    }

    function export()
    {


    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    function getById($id)
    {
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $posts = $this->model->find($id);
            if (isset($posts))
                return response_api(true, 200, null, $posts);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $is_active = (isset($attributes['is_active']) && $attributes['is_active'] == 'on') ? 1 : 0;
        $posts = new Post();
//        `title`, `detail`, `media`, `media_type`, `is_active`,
        $posts->title = $attributes['title'];
        if (isset($attributes['detail']))
            $posts->detail = $attributes['detail'];
        $posts->media_type = $attributes['media_type'];
        $posts->published_date = $attributes['published_date'];
        $posts->is_active = $is_active;
        if ($posts->save()) {

            if ($attributes['media_type'] == 'image')
                $posts->media = $this->storeImageThumb('posts', $posts->id, $attributes['media_image']);
            else
                $posts->media = $attributes['media_video'];
            $posts->save();
//            $posts->media = $attributes['media'];
//
            return response_api(true, 200, trans('app.created'), $posts);
        }
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        $is_active = (isset($attributes['is_active']) && $attributes['is_active'] == 'on') ? 1 : 0;

        // TODO: Implement update() method.
        $posts = $this->getById($id);
        $posts->title = $attributes['title'];
        if (isset($attributes['detail']))
            $posts->detail = $attributes['detail'];
        $posts->media_type = $attributes['media_type'];
        $posts->published_date = $attributes['published_date'];
        $posts->is_active = $is_active;
        if ($posts->save()) {
            if (isset($attributes['media'])) {
                if ($attributes['media_type'] == 'image')
                    $posts->media = $this->storeImageThumb('posts', $posts->id, $attributes['media_image']);
                else if ($attributes['media_type'] == 'video')
                    $posts->media = $attributes['media_video'];
                $posts->save();
            }

            if ($posts->save())
                return response_api(true, 200, trans('app.updated'), $posts);
        }
        return response_api(false, 422, null, []);


    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $posts = $this->model->find($id);
        if (isset($posts) && $posts->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $posts = $this->model->find($id);

        if (isset($posts)) {
            $posts->is_active = !$posts->is_active;
            $posts->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }
}
