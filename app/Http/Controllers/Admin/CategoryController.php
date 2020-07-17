<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
    if ($request->ajax()) {
            $data = Category::latest()->get();
          // dd($data->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('parent_id', function($row) {
                        if($row->parent_id != "")
                        {
                        return ($cat = Category::find($row->parent_id))?$cat->toArray()['category_name']:'N/A';
                        }
                        else
                        {
                            return 'N/A';
                        }
                        
                        // 
                    })
                    ->addColumn('action', function($row){
   
                           // $button= '<a href="'.url("/admin/users/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button =  '&nbsp;&nbsp;<a href="'.url("/admin/category/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url('/admin/category' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a>';

                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('admin.category.index');
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $categories = Category::pluck('category_name','id')->toArray();
        // array_unshift($data['categories'],=>'select');
        return view('admin.category.create',compact('categories'));
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
			'category_name' => 'required'
		]);
        $requestData = $request->all();
        
        Category::create($requestData);

        return redirect('admin/category')->with('flash_message', 'Category added!');
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
        $category = Category::findOrFail($id);

        return view('admin.category.show', compact('category'));
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category','categories'));
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
			'category_name' => 'required'
		]);
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('admin/category')->with('flash_message', 'Category updated!');
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
        if(Category::destroy($id))
        {
            echo "true";
            exit;
        }

         
    }
}
