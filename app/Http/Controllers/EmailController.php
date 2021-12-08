<?php

namespace App\Http\Controllers;

use App\Mail\AttachmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email()
    {
        Mail::to('heemaun@gmail.com')->send(new AttachmentMail());
    }
}
