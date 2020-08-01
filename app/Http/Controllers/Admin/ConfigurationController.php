<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Configuration::all();
        // dd($result->toArray());
        // foreach ($result as  $value) {

        //    $data[$value['key_name']] = array('title' =>$value['title'],'value'=>$value['value']);

        // }
        // dd($data);
        return view('admin.configuration.edit',compact('data'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $req = $request->all();
        unset($req['_token']);
        foreach ($req as $key=>$value) {
        $configuration = Configuration::findOrFail($key);
        $configuration->update(array('value' => $value ));
       
        }
        return redirect()->back();
    }
}
