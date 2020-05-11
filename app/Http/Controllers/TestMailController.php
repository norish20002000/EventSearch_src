<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestMailController extends Controller
{
    public function send() {
        return Mail::to('hello@gmail.com')->send(new TestMail());
    }
}
