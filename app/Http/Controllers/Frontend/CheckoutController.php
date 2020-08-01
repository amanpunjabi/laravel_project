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
use App\ProductVariation;
// use App\Http\Controllers\PaypalController;
use App\Services\PayPalService;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Exception;
use App\Http\Controllers\MailController;
// use App\Http\Controllers\Admin\CategoryController;

class CheckoutController extends Controller {

    protected $payPal;
    protected $mailctr;
    public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal; 
        $this->mailctr = new MailController();
    }
    public function index()
    {
        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = Cart::subtotal(2,'.','')-$discount;
        $newTax = $newSubTotal*$tax;
        $newTotal = $newSubTotal * (1 + $tax);

        return view('frontend.checkout',compact('cartCollection','user','address','discount','newSubTotal','newTotal','newTax'));
      
    }
    public function checkoutaddress() {

      if(auth()->check()) {
        if(count(Cart::content()) <=  0) {
          return redirect('/')->with('info','Please add item to your cart.');
        } 
        if(!anyItemOutOfstock()) {
          return redirect('/cart')->with('info','Please remove out of stock items from your cart.');
        } 
        $user = User::findOrFail(auth()->user()->id);
        $address = Address::where(array('user_id'=>$user->id,'type'=>'permanent'))->first();
        // $tax = config('cart.tax')/100;
        // $discount = session()->get('coupon')['discount'] ?? 0;
        // $newSubTotal = Cart::subtotal(2,'.','')-$discount;
        // $newTax = $newSubTotal*$tax;
        // $newTotal = $newSubTotal * (1 + $tax);

        // return view('frontend.checkout',compact('cartCollection','user','address','discount','newSubTotal','newTotal','newTax'));
         return view('frontend.checkout-address',compact('user','address'));
      }
      else
      {
        return redirect('login'); 
      }
    }
    public function ship_address(Request $request)
    {
     if(auth()->check()) {
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

      session()->put('address',[
          'firstname'=>$request->firstname,
          'lastname'=>$request->lastname,
          'email'=>$request->email,
          'phone'=>$request->phone,
          'address'=>$request->address,
          'city'=>$request->city,
          'state'=>$request->state,
          'pincode'=>$request->pincode,
      ]);
        $address = session()->get('address');
         // dd($address);
        $cartCollection = Cart::content();
        $user = User::findOrFail(auth()->user()->id);
        $address = Address::where(array('user_id'=>$user->id,'type'=>'permanent'))->first();

        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubTotal = Cart::subtotal(2,'.','')-$discount;
        $newTax = $newSubTotal*$tax;
        $newTotal = $newSubTotal * (1 + $tax);

        return view('frontend.checkout',compact('cartCollection','user','address','discount','newSubTotal','newTotal','newTax'));
         // return view('frontend.checkout',compact('user','address'));
      }
      else
      {
        return redirect('login'); 
      }
      // return view()
    }


    public function placeOrder(Request $request)
    {
        // Before storing the order we should implement the
        // request validation which I leave it to you
      // dd($request->all());
      // $param = session()->get('address');
      if(count(Cart::content()) <=  0) {
          return redirect('/')->with('info','Please add item to your cart.');
      } 
      if(!anyItemOutOfstock()) {
        return redirect('/cart')->with('info','Please remove out of stock items from your cart.');
      }  
      $param = session()->get('address');
      $param['_token'] = $request->get('_token');
      $dataPrice = getTotal();
      $param['coupon'] = '';
      if(session()->get('coupon')) {
        $param['coupon'] = session()->get('coupon')['code'];
      }
      // dd($param);
      $order = $this->storeOrderDetails($param);
      if($order) 
      {
        
        // $this->payPal->processPayment($order); 
        // the above functiion is for paypal payment processing
        

        //stripe payment is below
        // $userid = Auth::user()->id;
        // $user = User::find($userid);
        // $stripe_id = $user->stripe_id;
       
        // if($stripe_id == NULL)
        // {
        //   $customer = Stripe::customers()->create([
        //       'name'=>$user->firstname,
        //       'phone'=>$user->phone,
        //       'email' => $user->email,
        //   ]);
        //   $user->update(array('stripe_id'=>$customer['id']));
        // }
        try {
            
            $charge = Stripe::charges()->create([
              
              'currency' => 'USD',
              'source'=>$request->get('stripeToken'),
              'amount'   => $dataPrice['total'],

          ]);

          
        } 
        catch (Exception $e) {
          // dd($e);
           return redirect('/')->with('warning',"Payment Declined");
          
       }
      if($charge['status'] == "succeeded")
      {    
        session()->forget('coupon');    
        $order->update(['payment_status'=>1,'payment_method'=>'card']);

        $email = emailTemplate('order_placed');
        $email->message =   str_replace("{ORDER_ID}",$order->id,$email->message);
        $data['subject'] = $email->subject;
        $data['mess'] = $email->message;
        $data['email'] = auth()->user()->email ;
        // dd($data);
        $this->mailctr->register_email($data);

        return redirect('/')->with('success','Order placed and payment successfully');
      }
      else
      {
        return redirect('/')->with('warning','Payment Declined');
      }
      
    }
    else
    {
      return redirect('/')->with('warning','Fail To Place Order');
    }
       
    }
    public function storeOrderDetails($params)
    { 
      $order = Order::create([
        'order_number'      =>  'ORD-'.auth()->user()->id.strtoupper(md5(uniqid())),
        'user_id'           => auth()->user()->id,
        'status'            =>  'pending',
        'subtotal'          => getTotal()['subtotal'],
        'grand_total'       =>  getTotal()['total'],
        'discount'       =>  getTotal()['discount'],
        'tax'               => getTotal()['tax'],
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
        'coupon' =>$params['coupon'] ,
        // 'notes'             =>$params['notes']
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
                  'variation_id'  =>$item->options->variation_id,
              ]);
              // dd($orderItem);
              $variation = ProductVariation::find($orderItem->variation_id);
              // dd($variation);
              $order->items()->save($orderItem);
              $variation->decrement('quantity', $item->qty);
              
          }
          // dd($order->items());
        }
        Cart::destroy();
        return $order;
      }

      public function complete(Request $request)
        {
          // dd($request);
            $paymentId = $request->input('paymentId');
            $payerId = $request->input('PayerID');

            $status = $this->payPal->completePayment($paymentId, $payerId);
            dd($status);
            $order = Order::where('order_number', $status['invoiceId'])->first();
            $order->status = 'processing';
            $order->payment_status = 1;
            $order->payment_method = 'PayPal -'.$status['salesId'];
            $order->save();

            Cart::clear();
            return view('site.pages.success', compact('order'));
        }
}
