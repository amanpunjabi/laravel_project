<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Brand;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use DataTables;
use App\Product_image;
use App\ProductAttribute;
use App\Rules\Everynullelement;
use App\ProductVariation;
use Illuminate\Support\Arr; 
Use Alert;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    { 
        
         if ($request->ajax()) {
            $data = Product::latest()->get();
          // dd($data->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('brand_id', function($row) {
                        // if($row->brand_id != "")
                        // {
                        // return ($brand = Brand::find($row->brand_id))?$brand->toArray()['name']:'N/A';
                        // }
                        // else
                        // {
                        //     return 'N/A';
                        // }
                        return ($brand = $row->brand)?$brand->name:'N/A';
                        
                        // 
                    })
                    ->addColumn('action', function($row){
   
                           // $button= '<a href="'.url("/admin/users/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button =  '<div class="btn-group" role="group" aria-label=""><a href="'.url("/admin/products/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url('/admin/products' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a></div>';
                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::pluck('category_name','id')->toArray();
        $brands = Brand::pluck('name','id')->toArray();
        $attributes = ProductAttribute::pluck('name','id')->toArray();
        return view('admin.products.create',compact(['brands','categories','attributes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'code' => 'required', 
			'description' => 'required'
		],['name.required'=>'Product name required.']);

        $requestData = $request->all();
        // dd($requestData['category']);

        $product = new Product($requestData);
        $product->save();
        if ($request->has('category')) {
                $product->categories()->sync($request['category']);
        }
        // Product::create($requestData);

        return redirect('admin/products')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::pluck('category_name','id')->toArray();
        $brands = Brand::pluck('name','id')->toArray();
        $attributes = ProductAttribute::pluck('name','id')->toArray();
        $product = Product::findOrFail($id);
        // dd($product->categories->toArray());

        return view('admin.products.edit', compact(['brands','categories','product','attributes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required',
			'code' => 'required',
			'description' => 'required'
		]);
        $requestData = $request->all();
        if(!isset($requestData['featured']))
        {
            $requestData['featured'] = false;
        }
        if(!isset($requestData['recommended']))
        {
            $requestData['recommended'] = false;
        }
        $product = Product::findOrFail($id);
        $product->update($requestData);
        if ($request->has('category')) {
                $product->categories()->sync($request['category']);
        }

        return redirect('admin/products')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Product::destroy($id))
        {
            echo  true;
            exit;
        }

    }

    public function images($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.images',compact('product'));
    }
    
    public function save_image(Request $request,$id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ],['image.image'=>"File should be an Image"]);

       $product = Product::find($id);
       


       $requestData = $request->all();
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('product', 'public');
        }
        $image = new Product_image($requestData);

        $product->images()->save($image);
        return redirect()->back()->with('success',"images has been saved.");
    }

    public function remove_image($id)
    {
        if(Product_image::destroy($id))
        {
            echo "true";
            exit;
        }
    }

    public function product_attribute($id)
    {
        $product = Product::find($id);
        $attributes = ProductAttribute::all();
        return view('admin.products.attributes',compact('product','attributes'));
    }

    public function get_attribute_value(Request $request)
    {
        $attr = $request->get('attr');
        $data = "<div class='form-group row'>";
        if(empty($attr))
        {
            echo "";
            exit;
        }
        // foreach($attr as $id) {
           $productattribute = ProductAttribute::findOrFail($attr);
            $data.= "<select name='attribute_value' class='form-control col-lg-3 m-1'>";
            $data.= "<option value=''>select ".$productattribute->name."</option>";
           foreach ($productattribute->values as $value) {
            $data.= "<option value='".$value->value."'>".$value->value."</option>";
            }
          $data.= "</select>";
        // }
        echo $data;
        exit;
    }

    public function create_variant(Request $request,$id)
    { 
        // dd($request->all());
        // $this->validate($request,[
        //     'quantity' => 'required|numeric',
        //     'price' =>'required|numeric',
        //     'attribute_id'=>'required',
        //     'attribute_value_id'=>'required',
        //     ],['attribute_value_id.required'=>'please select at-least one attribute value','attribute_id.required'=>'please select at least one attribute']
        // );

    

        $oldval  = ProductVariation::where(array('product_id'=>$id,'attribute_id'=>$request->get('attribute_id'),'attribute_value'=>$request->get('attribute_value')))->count();
         
        if($oldval > 0)
        {
            return redirect()->back()->with('failed',"Variation already exists,please update it if want to change values.");
        }
        $product = Product::find($id);
      
      // dd($request->all());
      // $productvariation = new ProductVariation($request->all());
        $var = $product->variation()->create($request->all());
        
      //temprory
            // $attrval = new ProductAttributeAssigned();
            // $attrval->product_id = $id;
            // $attrval->price =$request->get('quantity');
            // $attrval->quantity =$request->get('price');
            // $attrval->product_variation_id = $var['id'];
            // $attrval->product_attribute_values_id = $stri;
            // $attrval->save();

      //endtemprory

      // dd($request['value_id']);
      // foreach ($request['value_id'] as $value) {
      //   if($value != null)
      //   {
      //       $attrval = new ProductAttributeAssigned();
      //       $attrval->product_id = $var['product_id'];
      //       $attrval->product_variation_id = $var['id'];
      //       $attrval->product_attribute_values_id = $value;
      //       $attrval->save();

      //   }
      // }

      return redirect()->back()->with('success',"Variation Created Successfull.");
    }

    public function remove_variant($id)
    {
        ProductVariation::destroy($id);
        return redirect()->back()->with('success', 'Variation deleted!');
    }

     public function get_variant_ajax(Request $request)
      {

       $variation =  ProductVariation::where(['product_id'=>$request->product_id,'attribute_value'=>$request->attribute_value,'attribute_id'=>$request->attribute_id])->first();
        echo json_encode($variation);
        exit;
      }
}
