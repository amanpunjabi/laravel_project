<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
   protected $primaryKey = 'key_name';
   protected $keyType = 'string';
   protected $fillable = ['value'];
}
