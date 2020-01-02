<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    //
     //
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schoolclass_id', 
        'subject_id',
        'year',
        'create_id',
        'delete_id',
        'update_id',
        'updated_at',
        'created_at',
        'updated_at',
    ];

}
