<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerifyUser extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id', 'token', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
