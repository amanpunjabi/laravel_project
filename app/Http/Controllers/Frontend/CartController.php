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


class CartController extends Controller
{
    public function shop()
    {
        
  
        $featured_products =  Product::paginate(6);
        $recommended_products =  Product::get()->where('recommended',true);
        return view('frontend.index',compact('featured_products','recommended_products'));
    }

    public function cart()  {
        $cartCollection = Cart::content();

        // dd($cartCollection); 
        return view('frontend.cart')->with(['cartCollection' => $cartCollection]);;
    }

    public function add(Request$request){

        Cart::add(array(
        'id'=>$request->id,
        'name'=>  $request->name,
        'price'=>$request->price,
         'qty' => $request->quantity,
             
           
        'options'=>array(
                'image' => $request->img,
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

}
