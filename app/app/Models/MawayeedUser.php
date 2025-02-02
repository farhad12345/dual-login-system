<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawayeedUser extends Model
{
protected $table = 'mawayeed_users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'last_logout',
        'status'
    ];
    public function projects()
    {
        return $this->hasMany(MawayeedDetails::class, 'employee_id');
    }
}
