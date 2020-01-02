<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discalendar extends Model
{
    //
        //
        protected $fillable = [
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
