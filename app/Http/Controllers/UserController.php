<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function registerUser()
    {
        // Get the data from the request or set to null, if data was not passed //
        $username = $_REQUEST['username'] ?? null;
        $name = $_REQUEST['name'] ?? null;
        $password = $_REQUEST['password'] ?? null;

        // Check if all data was passed //
        if ($username && $name && $password) {
            // Generate new user //
            $user = new User();

            // Set data to new user //
            $user->createUser($username, Hash::make($password), $name);
        }
    }

    public function loginUser()
    {
        // Get passed user credentials or set to null, if data was not passed //
        $username = $_REQUEST['username'] ?? null;
        $password = $_REQUEST['password'] ?? null;

        // Check if all the data was passed //
        if ($username && $password) {
            $user = new User();
            $user->loginUser($username, $password);
        }
    }
}
