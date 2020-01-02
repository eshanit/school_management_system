<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'middlename',
        'lastname',
        'gender_id',
        'dateofbirth',
        'create_id',
        'delete_id',
        'update_id',
        'updated_at',
        'created_at',
        'updated_at',
    ];

}
