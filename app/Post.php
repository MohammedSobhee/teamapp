<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['media100', 'media300'];


    public function getMedia100Attribute()
    {
        if ($this->media_type == 'image')
            return url('storage/app/posts/' . $this->id) . '/100/' . $this->getOriginal('media');
//        return url('assets/upload') . '/' . $this->getOriginal('media');
    }

    public function getMedia300Attribute()
    {
        if ($this->media_type == 'image')
            return url('storage/app/posts/' . $this->id) . '/300/' . $this->getOriginal('media');
//        return url('assets/upload') . '/' . $this->getOriginal('media');

    }

    public function getMediaAttribute($value)
    {
        if (isset($value) && $this->media_type == 'image')
            return url('storage/app/posts/' . $this->id) . '/' . $value;
        return $value;
    }
}
