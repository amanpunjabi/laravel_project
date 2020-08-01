<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Order;
use DataTables;
class ReportController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function salesReport(Request $request)
    {	
    	 // $data = DB::select('SELECT MIN(date(created_at)) as start_date,MAX(date(created_at)) as end_date, count(*) as number_of_orders,sum(grand_total) as grand_total,SUM(tax) as tax,SUM(item_count) as num_of_products FROM orders GROUP BY month(created_at) DESC');
    	 // dd($data);
        
    	if ($request->ajax()) {
    		$sql = 'SELECT MIN(date(created_at)) as start_date,MAX(date(created_at)) as end_date, count(*) as number_of_orders,sum(grand_total) as grand_total,SUM(tax) as tax,SUM(item_count) as num_of_products FROM orders';
    		$sql .= ' where date(created_at) between "'.$request->start_date.'" and "'.$request->end_date.'"';
    		// echo $request->filter_group."string";
    		// echo "<br>";
    		if($request->status != "")
    		{
    			$sql.= 'and status="'.$request->status.'"';
    		}
    		if($request->filter_group == "week") 
    		{
    			$sql .=' GROUP BY  week(created_at)  Order By week(created_at) DESC';
    		}
    		else if($request->filter_group == "year") 
    		{
    			$sql .=' GROUP BY  year(created_at)  Order By year(created_at) DESC';
    		}else if($request->filter_group == "month") 
    		{
    			$sql .=' GROUP BY month(created_at), year(created_at)  Order By year(created_at) DESC';
    		}else if($request->filter_group == "day") 
    		{
    			$sql .=' GROUP BY date(created_at)  Order By date(created_at) DESC';
    		}
    		
    		// echo $sql;
    		// exit;
            $data = DB::select($sql);
            return Datatables::of($data)
                    ->addIndexColumn() 
                    ->make(true);
        } 
        return view('admin.reports.index')->with('type','sales');
    }

    public function userReport(Request $request)
    {   
        // dd('aman');
         // $data = DB::select('SELECT MIN(date(created_at)) as start_date,MAX(date(created_at)) as end_date, count(*) as number_of_orders,sum(grand_total) as grand_total,SUM(tax) as tax,SUM(item_count) as num_of_products FROM orders GROUP BY month(created_at) DESC');
         // dd($data);
        
        if ($request->ajax()) {
            
            $query = User::latest(); 
            if(isset($request->start_date))
            {
              $query->where('created_at','>=',$request->start_date);
            }
            if(isset($request->end_date))
            {
              $query->where('created_at','<=',date('Y-m-d',strtotime("1 day",strtotime($request->end_date))));
            }
            // $query->where('id','<>',auth()->user()->id);
            // if(isset($request->payment_status))
            // {
            //   $query->where('payment_status',$request->payment_status);
            // }
            $data =  $query->get(); 
            // dd($data);  
            return Datatables::of($data)
                    ->addIndexColumn() 
                    ->addColumn('orders', function($row){
                         return "<a href='".route('admin.user.orders',$row->id)."'>".count($row->orders)."</a>"; 
                       
                    })
                    ->addColumn('item_count', function($row){
                        return $row->orders->sum('item_count');
                    })
                    ->addColumn('total', function($row){
                        return number_format($row->orders->sum('grand_total'),2);
                    })
                     ->rawColumns(['orders','item_count'])
                    ->make(true);
        } 
        return view('admin.reports.index')->with('type','user');
    }
    public function couponReport(Request $request)
    {   
        // dd('aman');
         // $data = DB::select('SELECT MIN(date(created_at)) as start_date,MAX(date(created_at)) as end_date, count(*) as number_of_orders,sum(grand_total) as grand_total,SUM(tax) as tax,SUM(item_count) as num_of_products FROM orders GROUP BY month(created_at) DESC');
         // dd($data);
        
        if ($request->ajax()) {
            
            $query = Order::latest(); 
            if(isset($request->start_date))
            {
              $query->where('created_at','>=',$request->start_date);
            }
            if(isset($request->end_date))
            {
              $query->where('created_at','<=',date('Y-m-d',strtotime("1 day",strtotime($request->end_date))));
            }

            $query->where('coupon','<>','');
            // $query->where('id','<>',auth()->user()->id);
            // if(isset($request->payment_status))
            // {
            //   $query->where('payment_status',$request->payment_status);
            // }
            $data =  $query->get(); 
            // dd($data);  
            return Datatables::of($data)
                    ->addIndexColumn() 
                    ->editColumn('order_number', function($row) {
                        // if($row->brand_id != "")
                        // {
                        // return ($brand = Brand::find($row->brand_id))?$brand->toArray()['name']:'N/A';
                        // }
                        // else
                        // {
                        //     return 'N/A';
                        // }
                        return "<a href='".route('admin.orders.show',$row->id)."'>$row->order_number</a>";
                        
                        // 
                    })
                    ->editColumn('discount', function($row) {
                        // if($row->brand_id != "")
                        // {
                        // return ($brand = Brand::find($row->brand_id))?$brand->toArray()['name']:'N/A';
                        // }
                        // else
                        // {
                        //     return 'N/A';
                        // }
                        return number_format($row->discount,2);
                        
                        // 
                    })
                     ->rawColumns(['order_number']) 
                    ->make(true);
        } 
        return view('admin.reports.index')->with('type','coupon');
    }

    public function userOrders($id) {

        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
        $user = User::find($id);
        return view('admin.reports.orderlist',compact('orders','user'));
        // dd($orders->all());
      }
}
