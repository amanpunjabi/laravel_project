<?php
use App\Configuration;
use App\Banner;
use App\Category;
use App\Brand;
use App\Wishlist;
use App\ProductAttribute;
use App\ProductAttributeValue;
use App\EmailTemplates;
use App\Coupon;
use App\ProductVariation;
// Use Alert;
// use Gloudemans\Shoppingcart\Cart;
if (!function_exists('getConfig')) {
    function getConfig($key)
    {
        if($row = Configuration::where('key_name',$key)->first())
        {
            return  $row->toArray()['value'];
        }
        else
        {
            return "";
        }
    }
}

function getBanners()
{
    return Banner::get();
}

function getCategories()
{
    return Category::get()->where('parent_id',null);
}
function getfeaturedCategories()
{
    return Category::whereHas('products')->where('featured',1)->get();
}

function getChildCategories($id)
{
    return Category::get()->where('parent_id',$id);
}

function getBrands()
{
    return Brand::get();
}

function wishlistcount()
{
    if(auth()->check())
    {
        return Wishlist::where('user_id',auth()->user()->id)->get()->count();
    }
    else
    {
        return 0;
    }
}

function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 

function get_attribute_name($id)
{
  $attribute = ProductAttribute::find($id) ?? null;
  // dd($attribute->name);
  if($attribute != null)
  {
    return $attribute->name;
  }
  else
  {
    return "N/A";
  }
  
}
function get_attribute_value($id)
{
  
  return $attribute = ProductAttributeValue::find($id)->value;
}

function emailTemplate($slug)
{
  return $email = EmailTemplates::where('slug',$slug)->first();
}

function checkIfCouponApplied($code=null) 
{
  // dd($code);
   $coupon = Coupon::where('code',$code)->first();  
    session()->put('coupon',[
      'code'=>$coupon->code,
      'discount'=>$coupon->discount(Cart::subtotal(2,'.','')),
    ]);
}   
function getTotal()
{
        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = Cart::subtotal(2,'.','')-$discount;
        $newTax = $newSubTotal*$tax;
        $newTotal = $newSubTotal * (1 + $tax);
        return array('tax'=>$newTax,'discount'=>$discount,'subtotal'=>$newSubTotal,'total'=>$newTotal);
}

function getMinMax($id){
  
  $data['max'] =    App\ProductVariation::where('product_id',$id)->max('price');
  $data['min'] =    App\ProductVariation::where('product_id',$id)->min('price');
  if($data['min']=='' || $data['max'] =='')
  {
    return null;
  }
  else
  { 
    if($data['max'] == $data['min'])
    {
      return "$".$data['max'];
    }
    else
    {
      return $price = '$'.number_format($data['min']).'- $'.number_format($data['max']);
    }
  }
}

function anyItemOutOfstock() {
  $cartCollection = Cart::content();
        foreach ($cartCollection as $item) {
          $variation = ProductVariation::find($item->options->variation_id);
          if($variation!=null) {
                if($variation->quantity <= 0) {
                  return false;
                }
          }
        }
        return true;
}