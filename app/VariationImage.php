<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationImage extends Model
{
    protected $table = "variation_images";
    protected $fillable = ['product_variation_id', 'image'];
   	public function product()
    {
    	return $this->belongsTo('App\Product');
    }

}
