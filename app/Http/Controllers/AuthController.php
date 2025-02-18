<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        //validator
        $validator = Validator::make($request->all(),[
            'shop_logo' => 'required',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'shop_phone' => 'required',
            'shop_email' => 'required',
            'name' => 'required',
            'number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,400
            );
        }

        // Create shop first
        $shop = new Shop();
        $shop->shop_logo = $request->shop_logo;
        $shop->shop_name = $request->shop_name;
        // Generate unique slug from shop name
        $baseSlug = Str::slug($request->shop_name);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and append counter until unique
        while (Shop::where('shop_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $shop->shop_slug = $slug;
        $shop->shop_address = $request->shop_address;
        $shop->shop_phone = $request->shop_phone;
        $shop->shop_email = $request->shop_email;
        $shop->save();

        // Create user and associate with shop
        $input = $request->all();
        $user = new User();
        $user->name = $request->name;
        $user->number = $request->number;
        $user->email = $request->email;
        $user->password = bcrypt($input['password']);
        $user->shop_id = $shop->id;
        $user->save();

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeMail($user));

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => "L'utilisateur s'est enregistré avec succès"
        ];

        return response()->json($response,200);
    }


        public function login(Request $request){
            $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'shop_slug' => 'required' // Add shop_slug validation
            ]);

            if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
            }

            if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
            ])) {
            $user = Auth::user();
            
            // Get associated shop information
            $shop = Shop::find($user->shop_id);
            if(!$shop) {
                Auth::logout();
                return response()->json([
                'success' => false,
                'message' => "Compte utilisateur non associé à une boutique"
                ], 401);
            }

            // Check if user is trying to login to the correct shop
            if($shop->shop_slug !== $request->shop_slug) {
                Auth::logout();
                return response()->json([
                'success' => false,
                'message' => "Vous n'êtes pas autorisé à vous connecter à cette boutique"
                ], 403);
            }

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['shop'] = [
                'id' => $shop->id,
                'name' => $shop->shop_name,
                'slug' => $shop->shop_slug
            ];

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => "Connecté avec succès"
            ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => "Coordonnées introuvables"
            ], 401);
        }

          public function get_auth_user_info(){

            $authIdUser = Auth::user()->id;

            $user = User::where('id',$authIdUser)->first();

            // dd($user);

            return $user;

        }



          public function reset_info_admin(Request $request){

          //  dd($request->all());

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required'
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

            $input = $request->all();


            $user_id = Auth::user()->id;

            $user = User::find($user_id);
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->number = $input['number'];
            $user->save();

            $response = [
                'success' => true,
                'message' => "successfully"
            ];
            return response()->json(
                $response,
                200
            );
        }
          public function reset_password(Request $request){

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|different:old_password',
                'c_password' => 'required|same:password'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 422);
            }

            $user = Auth::user();

            // Vérifier si l'ancien mot de passe est correct
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'L\'ancien mot de passe est incorrect.'
                ], 200);
            }

            // Si l'ancien mot de passe est correct, procéder au changement
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => "Mot de passe réinitialisé avec succès"
            ], 200);

}


public function forgot_password(Request $request){


   // dd($request->all());


    $validator = Validator()->make($request->all(),[
        'email' => 'required|email'
    ]);


    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors()
        ];
        return response()->json(
            $response
        );
    }


    $shop = Shop::first();

    $newPassword = Str::random(8);

    $user = User::where('email',$request->email)->first();

    Mail::to($request->email)->send(new ForgotPasswordMail($newPassword,$user,$shop));


    $input['password'] = bcrypt($newPassword);
    $user->password = $input['password'];

    $user->save();

    $response = [
        'success' => true,
        'message' => 'VOus Avez recu un nouveau mot de passe, Veillez consulter votre Email'
    ];
    return response()->json(
        $response,
        200
    );
}
}
