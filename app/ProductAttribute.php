<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_attributes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function values()
    {
        // return $this->belongsToMany('App\ProductAttributeValue', 'product_attribute_values', 'attribute_id', 'id');

        return $this->hasMany('App\ProductAttributeValue','attribute_id');
   
    }
}
