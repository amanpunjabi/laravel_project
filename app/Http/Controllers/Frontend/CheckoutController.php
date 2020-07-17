<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Http\Request;
Use Alert;
use Illuminate\Support\Facades\DB;
use Cart;
use App\User;
use App\Address;
 
use App\Order; 
use App\OrderItem;


// use App\Http\Controllers\Admin\CategoryController;

class CheckoutController extends Controller {

    public function index() {

      if(auth()->check()) {
        $cartCollection = Cart::content();
        $user = User::findOrFail(auth()->user()->id);
        $address = Address::where(array('user_id'=>$user->id,'type'=>'permanent'))->first();
        return view('frontend.checkout',compact('cartCollection','user','address'));
      }
      else
      {
        return redirect('login'); 
      }
      

    }

    public function placeOrder(Request $request)
    {
        // Before storing the order we should implement the
        // request validation which I leave it to you
      // dd($request->all());
      
       
        $order = $this->storeOrderDetails($request->all());

       
    }
    public function storeOrderDetails($params)
    {
    

        $order = Order::create([
        'order_number'      =>  'ORD-'.strtoupper(uniqid()),
        'user_id'           => auth()->user()->id,
        'status'            =>  'pending',
        'grand_total'       =>  Cart::subtotal(2,'.',''),
        'item_count'        =>  Cart::count(),
        'payment_status'    =>  0,
        'payment_method'    =>  null,
        'firstname'        =>  $params['firstname'],
        'lastname'         =>  $params['lastname'],
        'address'           => $params['address'],
        'city'              => $params['city'],
        'state'           =>  $params['state'],
        'pincode'         =>  $params['pincode'],
        'phone'      =>       $params['phone'],
        'notes'             =>$params['notes']
        ]);

        if ($order) {

          $items = Cart::content();

          foreach ($items as $item)
          {
              // A better way will be to bring the product id with the cart items
              // you can explore the package documentation to send product id with the cart


              $product = Product::where('name', $item->name)->first();
              // echo "<pre>";
              // print_r($item);
              $orderItem = new OrderItem([
                  'product_id'    =>  $product->id,
                  'quantity'      =>  $item->qty,
                  'price'         =>  $item->price*$item->qty,
              ]);
              // dd($orderItem);
              $order->items()->save($orderItem);
              
          }
          // dd($order->items());
        }
      Cart::destroy();
        return $order;
      }

}
;