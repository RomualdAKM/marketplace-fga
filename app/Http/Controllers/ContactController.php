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
            'name' => 'required',
            'email' => 'required|email',
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $shop = Shop::findOrFail($request->shop_id);

        Mail::to('romuald91303142@gmail.com')->send(new ContactMail(
            $request->message,
            $request->subject,
            $request->name,
            $request->email,
            $request->number,
            $shop->name
        ));

        Mail::to($shop->email)->send(new ContactMail(
            $request->message,
            $request->subject,
            $request->name,
            $request->email,
            $request->number,
            $shop->name
        ));

        $message = new Contact();
        $message->message = $request->message;
        $message->name = $request->name;
        $message->number = $request->number;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->shop_id = $shop->id;
        $message->save();

        return response()->json([
            'success' => true,
            'message' => "Contact message sent successfully"
        ], 200);
    }
    }
