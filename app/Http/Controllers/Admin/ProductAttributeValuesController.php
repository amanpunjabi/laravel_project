<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductAttributeValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $productattributevalues = ProductAttributeValue::where('attribute_id', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $productattributevalues = ProductAttributeValue::latest()->paginate($perPage);
        }

        return view('admin.product-attribute-values.index', compact('productattributevalues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product-attribute-values.create');
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
			'value' => 'required'
		]);
        $requestData = $request->all();
        
        ProductAttributeValue::create($requestData);

        return redirect()->back()->with('success', 'Product Attribute Value added!');
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
        $productattributevalue = ProductAttributeValue::findOrFail($id);

        return view('admin.product-attribute-values.show', compact('productattributevalue'));
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
        $productattributevalue = ProductAttributeValue::findOrFail($id);

        return view('admin.product-attribute-values.edit', compact('productattributevalue'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $productattributevalue = ProductAttributeValue::findOrFail($id);
        $productattributevalue->update($requestData);

        return redirect('admin/product-attribute-values')->with('flash_message', 'ProductAttributeValue updated!');
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
        ProductAttributeValue::destroy($id);

        return redirect()->back()->with('success', 'ProductAttributeValue deleted!');
    }
}
