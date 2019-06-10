<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;
use App\Models\Role;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * User belongsTo Role
     *@param null
     * @return object $role
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isAdministrator() {
        return $this->role->id === 1;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isAuthor() {
        return $this->role->id === 2;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isEditor() {
        return $this->role->id === 3;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isModerator() {
        return $this->role->id === 4;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isSubscriber() {
        return $this->role->id === 5;
    }


}
