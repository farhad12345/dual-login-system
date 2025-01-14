<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WahajWatanDetail extends Model
{
    protected $table = 'wahaj_watan_details';

    // Mass assignable attributes
    protected $fillable = [
        'employee_id',
        'record_number',
        'license_number',
        'origin_name',
        'email',
        'phone_number',
        'service',
        'site_link',
        'property_type',
        'area',
        'height',
        'width',
        'number_of_floors',
        'state',
        'city',
        'neighborhood',
        'street',
        'document', // Optional for file uploads
    ];
    public function employee()
    {
        return $this->belongsTo(WahajUser::class, 'employee_id');
    }

}
