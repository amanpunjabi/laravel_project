<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       
    if ($request->ajax()) {
            $data = ProductAttribute::latest()->get();
          // dd($data->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $button= '<a href="'.url("/admin/product-attributes/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button =  '&nbsp;&nbsp;<a href="'.url("/admin/product-attributes/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url('/admin/product-attributes' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a>';

                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.product-attributes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product-attributes.create');
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
			'name' => 'required|unique:product_attributes'
		]);
        $requestData = $request->all();
        
        ProductAttribute::create($requestData);

        return redirect('admin/product-attributes')->with('flash_message', 'ProductAttribute added!');
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
        $productattribute = ProductAttribute::findOrFail($id);

        return view('admin.product-attributes.show', compact('productattribute'));
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
        $productattribute = ProductAttribute::findOrFail($id);

        return view('admin.product-attributes.edit', compact('productattribute'));
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
			'name' => 'required|unique:product_attributes,name,' . $id,
		]);
        $requestData = $request->all();
        
        $productattribute = ProductAttribute::findOrFail($id);
        $productattribute->update($requestData);

        return redirect('admin/product-attributes')->with('flash_message', 'ProductAttribute updated!');
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
        if(ProductAttribute::destroy($id))
        {
            echo "true";exit();
        }
 
    }
}
