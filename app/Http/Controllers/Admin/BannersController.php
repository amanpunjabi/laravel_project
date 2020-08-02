<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DataTables;
use App\Banner;
use Illuminate\Http\Request;
Use Alert;
class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {  
        // $data = Banner::get()->toArray();
        // dd($data);
        if ($request->ajax()) {
            $data = Banner::latest()->get();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($row) {
                        if($row->status == "1")
                        {
                        return "active";
                        }
                        else
                        {
                            return "inactive";
                        }
                        
                        // 
                    })
                    ->addColumn('action', function($row){
   
                           $button= '<a href="'.url("/admin/banners/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url("/admin/banners/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url('/admin/banners' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a>';

                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('admin.banners.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
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
            'title' => 'required',
            'content' => 'required', 
            'image'=>'required|mimes:jpeg,png,jpg'
        ]);

        $requestData = $request->all();
                if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('banner', 'public');
        }

        Banner::create($requestData);

        return redirect('admin/banners')->with('success', 'Banner added!');
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
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
            'title' => 'required',
            'content' => 'required', 
            'image'=>'mimes:jpeg,png,jpg'
        ]);
        
        $requestData = $request->all();
                if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('banner', 'public');
        }

        $banner = Banner::findOrFail($id);
        $banner->update($requestData);

        return redirect('admin/banners')->with('success', 'Banner updated!');
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
        if(Banner::destroy($id))
        {
            echo "true";
            exit;
        }    
    }
    
    public function getList()
    {
       return Banner::get();
    }
}
