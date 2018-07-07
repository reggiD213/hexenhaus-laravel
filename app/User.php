<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
     * Checks if an user has admin privileges.
     *
     * @return bool
     */
    public function admin() {
        //dd($this->privileges);
        return $this->privileges & 16;
    }

    /**
     * Checks if an user has promoter privileges.
     *
     * @return bool
     */
    public function promoter() {
        return $this->privileges & 8;
    }

    /**
     * Checks if an user has booker privileges.
     *
     * @return bool
     */
    public function booker() {
        return $this->privileges & 4;
    }

    /**
     * Checks if an user has uploader privileges.
     *
     * @return bool
     */
    public function uploader() {
        return $this->privileges & 2;
    }

    /**
     * Checks if an user has member privileges.
     *
     * @return bool
     */
    public function member() {
        return $this->privileges & 1;
    }

}
