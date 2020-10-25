<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Pitch;
use App\PitchImage;
use App\PitchSchedule;
use App\PitchService;
use App\PitchSize;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use Intervention\Image\Size;

class PitchEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Pitch $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $pitches = $this->model->orderByDesc('created_at');

        return datatables()->of($pitches)
            ->filter(function ($query) {

//                $search = request()->get('query')['members_search'];
//
//                if (isset($search)) {
//                    $cities_id = City::where('name_en', 'LIKE', '%' . $search . '%')->pluck('id');
//
//                    $query->where(function ($query) use ($search, $cities_id) {
//                        $query->where('first_name', 'LIKE', '%' . $search . '%')->orWhere('last_name', 'LIKE', '%' . $search . '%')->orWhereIn('city_id', $cities_id);
//                    });
//                }
            })
            ->addColumn('image', function ($pitch) {
                $images = $pitch->Images()->get();
                if (count($images) > 0)
                    return '<img src="' . $images[0]->image100 . '"  class="rounded-circle">';
                return '';
            })
            ->addColumn('action', function ($pitch) {
                return '<a href="' . url(admin_pitches_url() . '/view/' . $pitch->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="عرض"><i class="la la-eye"></i></a>
                        <a href="' . url(admin_pitches_url() . '/' . $pitch->id . '/edit') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل"><i class="la la-edit"></i></a>
                        <a href="' . url(admin_pitches_url() . '/' . $pitch->id . '/delete') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete" title="حذف"><i class="la la-trash"></i></a>
                    ';
            })->addIndexColumn()
            ->rawColumns(['image', 'is_active', 'action'])->toJson();
    }


    function export()
    {


    }

    function getAll(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $collection = $this->model->where('status', 'active');

        if (isset($attributes['name'])) {
            $collection = $collection->where('name', 'LIKE', '%' . $attributes['name'] . '%');
        }

        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;

        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            return response_api(true, 200, null, $object, $page_count, $page_number, $count);
        }
    }


    function getById($id)
    {
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $pitch = $this->model->find($id);
            if (isset($pitch))
                return response_api(true, 200, null, $pitch);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function getByIdWithOutJson($id)
    {
        return $this->model->find($id);
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $pitch = new Pitch();
        $pitch->name = $attributes['name'];
        $pitch->owner_id = $attributes['owner_id'];
        $pitch->city_id = $attributes['city_id'];
        $pitch->address = $attributes['address'];
        $pitch->latitude = $attributes['latitude'];
        $pitch->longitude = $attributes['longitude'];
        if (isset($attributes['description']))
            $pitch->description = $attributes['description'];
        $pitch->cost_hour = $attributes['cost_hour'];
        $pitch->discount = $attributes['discount'];

        if ($pitch->save()) {
            // add sizes

            foreach ($attributes['size'] as $size) {
                $pitch_size = new PitchSize();
                $pitch_size->pitch_id = $pitch->id;
                $pitch_size->type = $size;
                $pitch_size->save();
            }

            // schedule time
            foreach ($attributes['is_schedule'] as $schedule) {

                foreach ($attributes['from'] as $key => $from) {
                    if ($key != $schedule) continue;
                    $index = 0;
                    foreach ($from as $time_from) {
                        $pitch_schedule = new PitchSchedule();
                        $pitch_schedule->pitch_id = $pitch->id;
                        $pitch_schedule->day = $schedule;
                        $pitch_schedule->from = $time_from;
                        $pitch_schedule->to = $attributes['to'][$schedule][$index++];
                        $pitch_schedule->save();
                    }
                }
            }

            // services
            if (isset($attributes['services']) && count($attributes['services']) > 0)
                foreach ($attributes['services'] as $service) {
                    $pitch_service = new PitchService();
                    $pitch_service->pitch_id = $pitch->id;
                    $pitch_service->service_id = $service;
                    $pitch_service->save();
                }

            //files
            if (isset($attributes['files']) && count($attributes['files']) > 0)
                foreach ($attributes['files'] as $file) {

                    $pitch_image = new PitchImage();
                    $pitch_image->pitch_id = $pitch->id;
                    if ($pitch_image->save()) {
                        sleep(1);
                        $pitch_image->image = $this->storeImageThumb('pitches', $pitch->id, $file);
                        $pitch_image->save();
                    }
                }
        }

        return response_api(true, 200, null, $pitch);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.

        $pitch = $this->getByIdWithOutJson($id);
        $pitch->name = $attributes['name'];
        $pitch->owner_id = $attributes['owner_id'];
        $pitch->city_id = $attributes['city_id'];
        $pitch->address = $attributes['address'];
        $pitch->latitude = $attributes['latitude'];
        $pitch->longitude = $attributes['longitude'];
        if (isset($attributes['description']))
            $pitch->description = $attributes['description'];
        $pitch->cost_hour = $attributes['cost_hour'];
        $pitch->discount = $attributes['discount'];

        if ($pitch->save()) {
            // add sizes
            if (isset($attributes['size']) && count($attributes['size']) > 0) {
                PitchSize::where('pitch_id', $pitch->id)->forceDelete();
                foreach ($attributes['size'] as $size) {
                    $pitch_size = new PitchSize();
                    $pitch_size->pitch_id = $pitch->id;
                    $pitch_size->type = $size;
                    $pitch_size->save();
                }
            }

            // schedule time
            if (isset($attributes['is_schedule']) && count($attributes['is_schedule']) > 0) {

                PitchSchedule::where('pitch_id', $pitch->id)->forceDelete();

                foreach ($attributes['is_schedule'] as $schedule) {

                    foreach ($attributes['from'] as $key => $from) {
                        if ($key != $schedule) continue;
                        $index = 0;
                        foreach ($from as $time_from) {
                            $pitch_schedule = new PitchSchedule();
                            $pitch_schedule->pitch_id = $pitch->id;
                            $pitch_schedule->day = $schedule;
                            $pitch_schedule->from = $time_from;
                            $pitch_schedule->to = $attributes['to'][$schedule][$index++];
                            $pitch_schedule->save();
                        }
                    }
                }
            }

            // services
            if (isset($attributes['services']) && count($attributes['services']) > 0) {
                PitchService::where('pitch_id', $pitch->id)->forceDelete();
                foreach ($attributes['services'] as $service) {
                    $pitch_service = new PitchService();
                    $pitch_service->pitch_id = $pitch->id;
                    $pitch_service->service_id = $service;
                    $pitch_service->save();
                }
            }


            //files
            if (isset($attributes['files']) && count($attributes['files']) > 0) {
                PitchImage::where('pitch_id', $pitch->id)->forceDelete();

                foreach ($attributes['files'] as $file) {

                    $pitch_image = new PitchImage();
                    $pitch_image->pitch_id = $pitch->id;
                    if ($pitch_image->save()) {
                        sleep(1);
                        $pitch_image->image = $this->storeImageThumb('pitches', $pitch->id, $file);
                        $pitch_image->save();
                    }
                }
            }
        }

        return response_api(true, 200, null, $pitch);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $object = $this->model->find($id);

        if (isset($object) && $object->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }
}
