<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PitchImage extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['image100', 'image300'];

    public function getImage100Attribute()
    {
        if (isset($this->attributes['image']))
            return url('storage/app/pitches/' . $this->pitch_id) . '/100/' . $this->attributes['image'];
        return null;
    }

    public function getImage300Attribute()
    {
        if (isset($this->attributes['image']))
            return url('storage/app/pitches/' . $this->pitch_id) . '/300/' . $this->attributes['image'];
        return null;
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/pitches/' . $this->pitch_id) . '/' . $value;
        return null;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/pitches/' . $model->pitch_id . '/' . $model->attributes['image']);
            $filename100 = storage_path('app/pitches/' . $model->pitch_id . '/100/' . $model->attributes['image']);
            $filename300 = storage_path('app/pitches/' . $model->pitch_id . '/300/' . $model->attributes['image']);
//
            if (file_exists($filename)) {
                unlink($filename);
                unlink($filename100);
                unlink($filename300);
                $model->delete();
            }

        });
    }
}
