<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    //
    use SoftDeletes;

    protected $casts = ['player_id' => 'integer', 'team_id' => 'integer'];

    public function Player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function Team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function ResultType()
    {
        return $this->belongsTo(ResultType::class, 'result_type_id');
    }
}
