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
        'document'
    ];
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
