<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function index()
    {
        Nexmo::message()->send([
            'to' => '8801751430596',
            'from' => 'sender',
            'text' => 'hello from nexmo'
        ]);

        echo "Message sent";
    }
}
