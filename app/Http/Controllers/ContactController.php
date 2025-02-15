<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send_mail(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'message' => 'required',
            // 'subject' => 'required',
            // 'number' => 'required',
            'name' => 'required',
          
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }

        $shop = Shop::find('1');

        Mail::to('romuald91303142@gmail.com')->send(new ContactMail($request->message,$request->subject,$request->name,$request->email,$request->number,$shop->name));
        Mail::to($shop->email)->send(new ContactMail($request->message,$request->subject,$request->name,$request->email,$request->number,$shop->name));

        $message = new Contact();
        $message->message = $request->message;
        $message->name = $request->name;
        $message->number = $request->number;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->save();

            $response = [
                'success' => true,
                'message' => "customer update successfully"
            ];
            return response()->json(
                $response,
                200
            );
        }
}
