<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
     protected $fillable = ['slug','subject','message'];
}
