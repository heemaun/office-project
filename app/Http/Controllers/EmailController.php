<?php

namespace App\Http\Controllers;

use App\Mail\AttachmentMail;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function email()
    {
        // Mail::to('heemaun@gmail.com')->send(new AttachmentMail());
        // Mail::to('heemaun@gmail.com')->send(new MyMail);
    }
    public function sendEmail(Request $request,$email)
    {
        $validator = Validator::make($request->all(),[
            'body' => 'required|min:10|max:1000',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>0,'errors'=>$validator->getMessageBag()]);
        }
        else{
            $emailData = [
                'sender' => $email,
                'text' => $request->body,
            ];
            Mail::to($request->names)->send(new MyMail($emailData));
            session()->put('email_send','Email sent successfully');
            return response()->json(['status'=>1]);
        }
    }
}
