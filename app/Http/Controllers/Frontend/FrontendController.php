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
use App\Coupon;
use Cart;
use App\Order;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Admin\CategoryController;

class FrontendController extends Controller
{
      public function index()
      {
       //  $categories = Category::get()->where('parent_id',null);
       //  $brands =  Brand::get();
       //  $featured_products =  Product::paginate(1);
 		    // $recommended_products =  Product::get()->where('recommended',true);
       //  return view('frontend.index',compact('categories','brands','featured_products','recommended_products'));
      }

      public function product_detail($id,$value=null)
      {
        $product = Product::where('id',$id)->first();
        if($product == null)
        {
           return view('404');
        }
        if($value!=null)
        {
          $variation = ProductVariation::where(['product_id'=>$id,'attribute_value'=>$value])->first();
          $product->variant = $variation;
          // print_r($product);
        }
      	
        

       
        // $variation = $product->variation;
        $attribute_values = ProductVariation::select('attribute_value')->where(['attribute_id'=>$product->attribute_id,'product_id'=>$id])->get()->toArray();
          
        
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
      //showing product list based on category
      public function ProductByCategory($id=null)
      {
        if($id == null)
        {
          $products = Product::whereHas('variation')->paginate(20);
          $categoryname = "In All Category";
        }
        else
        {
          $category = Category::where('id',$id)->orWhere('parent_id',$id)->pluck('id')->toArray();
          $categoryname = Category::where('id',$id)->first()->category_name;
          $productIds  = DB::table('product_categories')->whereIn('category_id',$category)->pluck('product_id');
          $products = Product::whereHas('variation')->whereIn('id',$productIds)->paginate(20);
          // dd($products->all());
        }
        

         return view('frontend.product-list',compact('products','categoryname'));
      }

      public function ProductBySearch(Request $request)
      {

        $search = $request->search_query;
        // dd($search);
        if($search == null)
        {
          $products = Product::whereHas('variation')->paginate(20);
          $search = "All Products";
        }
        else
        {
 
          $products = Product::whereHas('variation')->where('name','LIKE', "%$search%")->orWhere('description','LIKE', "%$search%")->paginate(20);
        }
        

         return view('frontend.product-search-result',compact('products','search'));
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
          $featured_products = Product::whereHas('variation')->whereIn('id',$wishlist)->get();
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

        $this->validate($request, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'phone' => 'required|numeric',
          'address'=>'required',
          'city'=>'required',
          'state'=>'required',
          'pincode'=>'required'
        ]);
            
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

      public function storeCoupon(Request $request) {
        $validator = Validator::make($request->all(),['coupon_code'=>'required']);
        $validator->validate();
         $coupon = Coupon::where('code',$request->coupon_code)->first();
         if(!$coupon)
         {
           $validator->errors()->add('coupon_code', 'Invalid Coupon Code');
           return redirect()->route('cart.index')->withErrors($validator);
         }
         
        session()->put('coupon',[
          'code'=>$coupon->code,
          'discount'=>$coupon->discount(Cart::subtotal(2,'.','')),

        ]);
        return redirect()->route('cart.index')->with('success','Coupon has been applied.');
       // dd($coupon);
        // dd($request->all());
      }   
      public function destroyCoupon(Request $request) {
         session()->forget('coupon');
         return redirect()->route('cart.index')->with('success','Coupon has been removed.');

      }

      public function myOrders() {

        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        return view('frontend.orders',compact('orders'));
        dd($orders->all());
      }

      public function viewOrder($id) {
        $order = Order::findOrFail($id);
        return view('frontend.view-order', compact('order'));
        dd("aman");
      }

      public function categoryContent($id)
      {
        $category = Category::find($id);
        return view('frontend.category-tab-content',compact('category'));exit();  
      }
} 