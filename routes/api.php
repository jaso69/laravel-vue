<?php

use App\User;
use App\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('user', function (){
    return auth()->user();
});
Route::post('login', function (){
    if($user = User::whereEmail(request('email'))->first() ){
        if (Hash::check(request('password'), $user->password) ){
            return response()->json([
                'message' => 'hola' . $user->name,
                'api_token' => $user->api_token,
            ], 200);
        }
    }
    return response()->json([
        'message' => 'Inutil no te sabes tus putas credenciales',
        'api_token' => null,
    ], 401);
});

Route::post('register', function(){
    return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'api_token' => Str::random(60),
        ]);
});

Route::middleware('auth:api')->get('notas', function(){
    return response()->json(Agenda::where('user_id', auth()->user()->id)->get());
});


