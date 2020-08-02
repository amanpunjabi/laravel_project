<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
Use Alert;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // dd();
        if ($request->ajax()) {
            $data = User::latest()->where('id', '<>', auth()->user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $button= '<div class="btn-group" role="group" aria-label=""><a href="'.url("/admin/users/" .$row->id).'" title="View User"  class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url("/admin/users/" . $row->id. "/edit").'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>  </a>';

                           $button.=  '&nbsp;&nbsp;<a href="'.url('/admin/users' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a></div>';

                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('admin.users.index');
            
            
                                       
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
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
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users',
            'phone'=>'required', 
            'confirm_password'=>'same:password',
			'password' => 'required'
		]);
        $requestData = $request->all();
        
        User::create($requestData);

        return redirect('admin/users')->with('success', 'User added!');
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
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
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
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
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
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users,email,' . $id,
            'confirm_password'=>'same:password',

		]); 
        $requestData = $request->all();
        if($requestData['password'] == "")
        {
            unset($requestData['password']);
        }
        else
        {
            $requestData['password'] = Hash::make($requestData['password']); 
        }
        $user = User::find($id);
        $user->update($requestData);

        return redirect('admin/users')->with('success', 'User updated!');
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
        if(User::destroy($id))
        {
            echo  true;
            exit;
        }

        // return redirect('admin/users')->with('success', 'User deleted!');

    }
}
