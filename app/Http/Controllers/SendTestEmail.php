<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestJobs;

class SendTestEmail extends Controller
{
    

    public function sendMail()
    {
        $mailData['to'] = 'zilanise@gmail.com';
        $mailData['subject'] = 'Test Mail';
        $mailData['message'] = 'Sending Test EMail with laravel queue';
        $mailData['name'] = 'Towsif';

        TestJobs::dispatch($mailData);

        return response('Email sent successfully');
    }
}
