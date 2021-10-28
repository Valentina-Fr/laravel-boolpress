<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{   
    public function contact() {
        return view('guest.contact');
    }

    public function send(Request $request) {
       $data = $request->all();
       $lead = new Lead();
       $lead->fill($data);
       $lead->save();

       Mail::to('account@mail.it')->send(new SendNewMail($lead));
       return redirect()->route('guest.thanks');
    }

    public function thanks() {
        return view('guest.thanks');
    }
}
