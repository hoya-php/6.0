<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function input() {

        return view('contact.input');

    }

    public function send(ContactRequest $request) {

        // ここでメール送信

    }
}
