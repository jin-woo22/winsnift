<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\Contact;

use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function home()
    {
        return view('main.pages.home');
    }

    public function about()
    {
        return view('main.pages.about');
    }
    
    public function faq(Request $request)
    {
        return view('main.pages.faq');
    }

    public function contact_us(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $message = $request->input('message');

        Mail::to(users:'admin@wimsnift.online')->send(new Contact($name,$email,$phone,$message));

        return redirect()->back();
    }
}