<?php
use App\Configuration;
use App\Banner;
use App\Category;
use App\Brand;
use App\Wishlist;
use App\ProductAttribute;
use App\ProductAttributeValue;
use App\EmailTemplates;
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
  $attribute = ProductAttribute::find($id);
  // dd($attribute->name);
  return $attribute->name;
}
function get_attribute_value($id)
{
  return $attribute = ProductAttributeValue::find($id)->value;
}

function emailTemplate($slug)
{
  return $email = EmailTemplates::where('slug',$slug)->first();
}