<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawayeedProject extends Model
{
    protected $table = 'mayeed_projects';
    protected $fillable = [
        'employee_id',
        'invitation_name',
        'occasion',
        'day',
        'date',
        'status',
        'city',
        'time',
        'address',
        'link',
        'image',
        'type',
        'email',
        'reason'
    ];
    public function employee()
    {
        return $this->belongsTo(MawayeedUser::class);
    }
}
