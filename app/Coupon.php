<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

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
    protected $fillable = ['code', 'type', 'value', 'expire_on'];

    public static function findByCode($code){
        return self::where('code',$code)->first();
    }
    public function discount($total) {
        // dd($total);
        if($this->type == 'fixed') {
            return $this->value;
        }
        else if($this->type == 'percent'){
            return ($this->value/100)*$total;
        }
        else {
            return 0;
        }
    }
    public function orders() {
        return $this->hasMany('App\Order','coupon','id');
    }
}
