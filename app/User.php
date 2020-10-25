<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 * @package App
 *
 * @property string name
 * @property string username
 * @property string password
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'user_id';

    /**
     * @param string $username
     * @param string $password
     * @param string $name
     */
    public function createUser(string $username, string $password, string $name): void
    {
        if (!$this->userExists($username)) {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->save();
        Auth::login($this);
        }
    }

    /**
     * @param string $username
     * @return bool
     */
    public function userExists(string $username): bool
    {
        return !empty(DB::table('users')->where('username', '=', $username)->first());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUserName() {
        if (Auth::check()) {
            return DB::table('users')->where('user_id', '=', Auth::id())->first()->name;
        } else {
            throw new \Exception('User is not logged in!');
        }
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function loginUser(string $username, string $password): void
    {
        $result = DB::table('users')->where('username', '=', $username)->first();

        $hashedPassword = $result->password ?? null;
        if ($hashedPassword) {
            if (Hash::check($password, $hashedPassword)) {
                Auth::loginUsingId($result->user_id);
            }
        }
    }
}
