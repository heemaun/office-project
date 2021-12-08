<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TestEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestsEnrollmentController extends Controller
{
    public function sendTestNotification()
    {
        $user = User::first();

        $enrolementData = [
            'body' => 'you recieved a new test notification',
            'enrollmentText' => 'you are allowed to enroll',
            'url' => '/',
            'thankyou' => 'you have 14 days to enroll'
        ];

        // $user->notify(new TestEnrollment($enrolementData));
        Notification::send($user, new TestEnrollment($enrolementData));
    }
}
