<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ContactUs;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\MailController;

class ContactUsController extends Controller
{
    protected $mailctr;
    public function __construct()
    {
        $this->mailctr = new MailController();
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $button=  '&nbsp;&nbsp;<a href="'.url('/admin/users' . '/' . $row->id).'" title="Edit User" class="btn btn-primary btn-sm" onclick="return show_warning(this);" id='.$row->id.'><i class="fa fa-trash" aria-hidden="true"></i>  </a>';

                            return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('admin.contact.index');
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required', 
            'message'=>'required',  
        ]);
        ContactUs::create($request->all());
        $email = emailTemplate('contact_us');
        $email->subject = str_replace("{SUBJECT}","Message Received",$email->subject);
        $email->message =   str_replace("{RECIPIENT}","Admin",$email->message);
        $email->message =   str_replace("{SENDER}",$request->name,$email->message);
        $email->message =   str_replace("{NAME}",$request->name,$email->message);
        $email->message =   str_replace("{EMAIL}",$request->email,$email->message);
         $email->message =   str_replace("{SUBJECT}",$request->subject,$email->message);
        $email->message =   str_replace("{COMMENT}",$request->message,$email->message);
        $data['subject'] = $email->subject;
        $data['mess'] = $email->message;
        $data['email'] = getConfig('email');
        // dd($data);
        $this->mailctr->register_email($data);


        \Session::flash('message', 'Wait For Response!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if(ContactUs::destroy($id))
        {
            echo  true;
            exit;
        }
    }
}
