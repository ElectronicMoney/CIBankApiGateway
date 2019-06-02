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
}
