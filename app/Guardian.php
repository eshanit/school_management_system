<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'middle_name',
        'last_name',
        'idnumber',
        'address',
        'phonenumber',
        'email',
        'create_id',
        'delete_id',
        'update_id',
        'updated_at',
        'created_at',
        'updated_at',
    ];

}
