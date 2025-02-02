<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WahajUser extends Model
{
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
        return $this->hasMany(WahajWatanDetail::class, 'employee_id');
    }
}
