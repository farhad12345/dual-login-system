<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageForm extends Model
{
    protected $fillable = [
        'first_name',
        'fathers_name',
        'grandfathers_name',
        'thing',
        'village',
        'event_date',
        'today_date',
        'city_of_occassion',
        'hall',
        'her_address',
        'brides_fathers_name',
        'her_village',
    ];
}
