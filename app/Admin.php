<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use SoftDeletes, Notifiable;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['logo100', 'logo300'];

    public function getLogo100Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/admins/' . $this->id) . '/100/' . $this->attributes['logo'];
        return null;
    }

    public function getLogo300Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/admins/' . $this->id) . '/300/' . $this->attributes['logo'];
        return null;
    }

    public function getLogoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/admins/' . $this->id) . '/' . $value;
        return null;
    }

    public function Roles()
    {
        return $this->belongsToMany(Role::class, 'admin_roles', 'admin_id', 'role_id')->whereNull('admin_roles.deleted_at');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
