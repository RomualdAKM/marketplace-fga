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
  
          $input = $request->all();
          $input['password'] = bcrypt($input['password']);
         // $user = User::create($input);
  
         $user = new User();
         $user->name = $request->name;
         $user->number = $request->number;
         $user->email = $request->email;
         $user->password = $input['password'];
         $user->save();

         // Envoyer l'e-mail de bienvenue
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
  
              if (Auth::attempt([
                  'email' => $request->email,
                  'password' => $request->password
              ])) {
                   $user = $request->user();
                  $success['token'] = $user->createToken('MyApp')->plainTextToken;
                  $success['name'] = $user->name;
  
                  $response = [
                      'success' => true,
                      'data' => $success,
                      'message' => "Connecté avec succès"
                  ];
                  return response()->json($response, 200);
              }else {
                  $response = [
                      'success' => false,
                      'message' => "Coordonnée introuvable"
                  ];
                  return response()->json($response);
              }
  
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
