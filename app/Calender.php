<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    //
    protected $fillable = [
        'school_id', 
        'event_date',
        'event_heading',
        'event_description',
        'delete_id',
        'update_id',
        'updated_at',
        'created_at',
        'updated_at',
    ];
}
