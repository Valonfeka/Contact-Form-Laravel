<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function postContact(Request $request){
        $this->validate($request,[
            'first_name'=>'required|min:2',
            'last_name'=>'required|min:2',
            'email'=>'required|email',
            'subject'=>'required|min:3',
            'message'=>'min:3'
        ]);
        $data =array(
            'first_name'=>$request->first_name,
            'last_name'=> $request->last_name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodyMessage' => $request->message
        );
        Mail::send('contact',$data,function($message)use ($data){
            $message->from($data['email']);
            $message->to('valon.fek@gmail.com');
            $message->subject($data['subject']);
        });

    }
}
