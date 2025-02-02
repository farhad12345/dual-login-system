<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'employee_id',
        'company_name',
        'service_required',
        'start_date',
        'completion_date',
        'status',
        'city',
        'commertial_register',
        'person_contact',
        'person_name',
        'service_type',
        'document',
        'days',
        'email',
        'ministry',
        'business_type',
        'commertial_register_number',
        'type',
        'country',
        'reason'
    ];
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
