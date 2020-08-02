<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailTemplates;
use DataTables;
Use Alert;
class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
         if ($request->ajax()) {
            $data = EmailTemplates::latest()->get();
          // dd($data->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            
                           // $button= '<a href="'.url("/admin/users/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button =  '&nbsp;&nbsp;<a href="'.url("/admin/email/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';
                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.email.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = EmailTemplates::findOrFail($id);
        return view('admin.email.edit', compact('email')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'slug' => 'required',
            'subject' => 'required',
            'message' => 'required', 
        ]);
        $requestData = $request->all();
        $email = EmailTemplates::findOrFail($id);
        $email->update($requestData);
        return redirect('admin/email')->with('success', 'Page updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
