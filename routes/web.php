<?php

use App\Models\Shop;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{pathMatch}', function () {
//     $shop = Shop::first();

//     if (request()->is('dashboad/*')) {
//         return view('dashboad', compact('shop'));
//     }

//     return view('welcome', compact('shop'));
// });


// Route::get('/dashboad/statistic', function () {
//     $shop = Shop::first();

//     return view('dashboad')->with('shop', $shop);
// });
Route::get('/home/{any}', function () {
    return view('home');
})->where('any', ".*");


Route::get('/dashboad/{any}', function () {
    $shop = Shop::first();
    return view('dashboad', compact('shop'));
})->where('any', ".*");



Route::get('/{pathMatch}', function () {
    $shop = Shop::first();
    return view('welcome', compact('shop'));
})->where('pathMatch', ".*");




