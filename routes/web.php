<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('roomOption');
    } else {
        return view('register');
    }
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::post('/register', function () {
    $userController = new UserController();
    $userController->registerUser();
    if (Auth::check()) {
        return redirect('roomOption');
    } else {
        return redirect('register');
    }
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('roomOption');
    } else {
        return view('login');
    }
})->name('login');

Route::post('/login', function () {
    $userController = new UserController();
    $userController->loginUser();
    if (Auth::check()) {
        return redirect('roomOption');
    } else {
        return redirect('login');
    }
});

Route::get('/room/{roomId}', function ($roomId) {
    return view('room');
})->middleware('auth');

Route::get('/roomCreate', function () {
    return view('roomCreate');
})->middleware('auth');

Route::post('/roomCreate', function () {
    $roomController = new RoomController();
    $roomID = $roomController->createRoom();
    if ($roomID) {
        return redirect(sprintf('room/%s', $roomID));
    } else {
        throw new Exception('There was a problem creating a room!');
    }
})->middleware('auth');

Route::get('/roomJoin', function () {
    return view('roomJoin');
})->middleware('auth');

Route::post('/roomJoin', function () {
    $roomController = new RoomController();
    return $roomController->joinRoom();
})->middleware('auth');

Route::get('/roomOption', function () {
    return view('roomOption');
})->middleware('auth');

Route::post('/roomGetUsers', function () {
    $roomController = new RoomController();
    $roomUsers = $roomController->getRoomUsers();
    return new JsonResponse([
        'status' => 'success',
        'data' => $roomUsers
    ]);
});

Route::get('/user', function () {
    return view('user');
})->middleware('auth');
