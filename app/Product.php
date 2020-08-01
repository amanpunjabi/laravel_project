<?php

namespace App;
use App\Category;
use App\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['name', 'code', 'brand_id', 'price', 'special_price', 'description', 'status','featured','attribute_id','recommended'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Brand','id','brand_id');
    }
    public function images()
    {
        return $this->hasMany('App\Product_image');
    }

    // public function variation()
    // {
    //     return $this->hasMany('App\ProductVariation','id','product_id');
    // }
        
    public function variation()
    {
        return $this->hasMany('App\ProductVariation');
    }
}
