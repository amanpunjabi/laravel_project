<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\Category;
use App\Brand;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
Use Alert;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Address;
use App\ProductAttributeValue;
use App\ProductVariation;
use Newsletter;
// use App\Http\Controllers\Admin\CategoryController;

class FrontendController extends Controller
{
      public function index()
      {
        $categories = Category::get()->where('parent_id',null);
        $brands =  Brand::get();
        $featured_products =  Product::paginate(1);
 		    $recommended_products =  Product::get()->where('recommended',true);
        return view('frontend.index',compact('categories','brands','featured_products','recommended_products'));
      }

      public function product_detail($id,$valueId=null)
      {
        $product = Product::where('id',$id)->first();
        if($valueId!=null)
        {
          $variation = ProductVariation::where(['product_id'=>$id,'attribute_value_id'=>$valueId])->first();
          $product->variant = $variation;
          // print_r($product);
        }
      	
        

       
        // $variation = $product->variation;
        $attribute_values = ProductVariation::select('attribute_value_id')->where('attribute_id',$product->attribute_id)->get()->toArray();
          
        
        // $str = "";
        // $numItems = count($product->variation);
        // $i=0;
        // foreach ($product->variation as $variation) {
        //   if(++$i != $numItems)
        //   {
        //     $str .= $variation->product_attribute_values_id.",";
        //   }
        //   else
        //   {
        //     $str .= $variation->product_attribute_values_id;
        //   }
        // }
        // $valueIds =  explode(",", $str);
        // $valueIds = array_unique($valueIds);
        // $attributes = array();
        // foreach ($valueIds as $value) {
        //   $attrVal = ProductAttributeValue::find($value);
        //   $attributes["$attrVal->attribute_id"][] = $value;
        // }
        // dd($attribute);
        // dd($product->variation[0]->product_attribute_values_id);
      	return view('frontend.product-details',compact('product','attribute_values'));

      }

      public function add_wishlist($id)
      {
        try 
        {
          
          Wishlist::create(array('user_id'=>auth()->user()->id,'product_id'=>$id));
        } 
        catch (\Illuminate\Database\QueryException $e) {
             return redirect()->back()->with('success', 'Already Added to Wishlist!');
        }
         return redirect()->back()->with('success', 'Added to Wishlist!');
      }

      public function wishlist()
      {
        
         // dd(auth()->user()->id);
          // DB::enableQueryLog();
          // $query = DB::getQueryLog();
          // $lastQuery = end($query);
          // print_r($lastQuery);
          $wishlist =  Wishlist::where('user_id',auth()->user()->id)->select('product_id')->distinct()->pluck('product_id')->toArray();
          // echo "<pre>";
          
         
          // dd($wishlist);
          $featured_products = Product::whereIn('id',$wishlist)->get();
          // dd($featured_products);
          return view('frontend.wishlist',compact('featured_products'));
      }

      public function remove_wishlist($id)
      {
        Wishlist::where(['product_id'=>$id,'user_id'=>auth()->user()->id])->delete();
        return redirect()->back()->with('success', 'Remove from Wishlist!');
      }
      
      public function profile()
      {
        $user = auth()->user();

        foreach($user->address as $address)
        {
          if($address->type == 'permanent')
          {
            break;
          }
        }
        if(empty($address))
        {
          $address = [];
        }
        return view('frontend.profile',compact('user','address'));
      }
      
      public function profile_update(Request $request) {

        // $this->validate($request, [
        //   'firstname' => 'required',
        //   'lastname' => 'required',
        //   'email' => 'required|email',
        //   'phone' => 'required|numeric',
        //   'address'=>'required',
        //   'city'=>'required',
        //   'state'=>'required',
        //   'pincode'=>'required'
        // ]);
            
        $requestData = $request->all();
        // dd($requestData);
        
        $user = User::findOrFail(auth()->user()->id);
        $user->update($requestData);
        $addressData = array('user_id'=>$user->id,'address'=>$requestData['address'],'city'=>$requestData['city'],'state'=>$requestData['state'],'pincode'=>$requestData['pincode'],'type'=>'permanent');
          // dd($requestData['address']);
        $address = Address::where(array('user_id'=>$user->id,'type'=>'permanent'))->first();
        // dd($address);
        if(!empty($address))
        {
          $address->update($addressData);
          $address = Address::where(array('user_id'=>$user->id,'type'=>'permanent'))->first();
          // dd($address);
        }
        else
        {
          $address = new Address();
          $address::create($addressData);
          // dd($address);
        }
        

        return redirect()->back()->with('success', 'Profile Updated!');
      }

      public function subscribe(Request $request)
      {
        $this->validate($request, [
          'email' => 'required|email'
        ]);

        if ( ! Newsletter::isSubscribed($request->email) ){
            Newsletter::subscribe($request->email);
            return redirect()->back()->with('success', 'Subscribed Successfully!');
          }
          return redirect()->back()->with('info', 'Already Subscribed!');
      }


      //static page for cms

      public function get_page(Request $request)
      {
        echo "string";
        dd($request);
      }
}
