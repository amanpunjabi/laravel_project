<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $table = 'address';
    protected $fillable = ['user_id', 'address', 'city', 'state', 'pincode','type'];
    public $timestamps = false;

}
