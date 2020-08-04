<?php 
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use DataTables;
use App\Category;
use App\Brand;
Use Alert;
use Cart;
use App\ProductVariation;


class CartController extends Controller
{
    public function shop()
    {
        // return view('welcome');
  
        $featured_products =  Product::whereHas('variation')->where('featured',true)->paginate(8);
        // whereHas('variation')->
        // dd($featured_products); 
        $recommended_products =  Product::whereHas('variation')->get()->where('recommended',true);
        return view('frontend.index',compact('featured_products','recommended_products'));
    }

    public function cart()  {
        $cartCollection = Cart::content();
        $tax = config('cart.tax')/100;
        // dd($tax);
        if($code = session()->get('coupon'))
        {
            checkIfCouponApplied($code['code']);   
        }
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = Cart::subtotal(2,'.','')-$discount;
        $newTax = $newSubTotal*$tax;
        $newTotal = $newSubTotal * (1 + $tax);
        
 
        // dd($cartCollection); 
        return view('frontend.cart',compact(['discount','newSubTotal','newTax','newTotal','cartCollection']));
    }

    public function add(Request $request){
        // if(isset($request->variation_id)) {
        //     $variation = ProductVariation::find($request->variation_id);
        //     if($variation->quantity < $request->quantity) {

        //         return redirect()->back()->withErrors(array('quantity'=>"Quantity Not Available"));   
        //     }
        //     // dd($variation->quantity);
        // }
        // dd($request->all());
        $this->validate($request, [
          'attribute_id' => 'required', 
         ],['attribute_id.required'=>"please select attribute"]);
        // dd($request->all());
        Cart::add(array(
        'id'=>$request->id,
        'name'=>  $request->name,
        'price'=>$request->price,
         'qty' => 1,
             
           
        'options'=>array(
                'image' => $request->img,
                'variation_id' =>$request->variation_id,
                // 'slug' => $request->slug
            )
        ));
        // return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
      

        return redirect()->back()->with('success', 'Add To Cart Successfully!');
    }

    public function remove(Request $request)
    {
        Cart::remove($request->get('rowId'));
        return redirect()->back()->with('success', 'Item Removed From Cart!');
         
    }

    public function update(Request $request) {
        $rowId = $request->rowId;
        $cart = Cart::get($rowId);
        $quantity = $cart->qty;
        if($request->type == "minus") {
            Cart::update($rowId,$quantity-1);
            return redirect()->back()->with('success','quantity updated');
        }
        else {

            if(ProductVariation::find($cart->options['variation_id'])->quantity < $quantity+1) {
                return redirect()->back()->with('info','quantity cannot be added');
            }
            else {
                Cart::update($rowId,$quantity+1);
                return redirect()->back()->with('success','quantity updated');
            }
        }
        // dd($request->all());
    }
}
