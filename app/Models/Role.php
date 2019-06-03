<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function administrator()
    {
        return User::find(1);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function author()
    {
        return User::find(2);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function editor()
    {
        return User::find(3);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function moderator()
    {
        return User::find(4);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function subscriber()
    {
        return User::find(5);
    }

}
