<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Authorization
{

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function authUserIsResourceOwner($userId)
    {
        if (Auth::user()->id == $userId) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function authUserIsNotResourceOwner($userId) {
        return $this->authUserIsResourceOwner($userId) ? false: true;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isAdministrator()
    {
        if (Auth::user()->role->id == 1) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isNotAdministrator() {
        return $this->isAdministrator() ? false: true;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isAuthor()
    {
        if (Auth::user()->role->id == 2) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isEditor()
    {
        if (Auth::user()->role->id == 3) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isModerator()
    {
        if (Auth::user()->role->id == 4) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isSubscriber()
    {
        if (Auth::user()->role->id == 5) {
            return true;
        }
        return false;
    }

    /**
     * Role hasMany User
     *@param null
     * @return object $user
     */
    public function isOthers()
    {
        if ($this->isEditor() || $this->isAuthor() || $this->isModerator() || $this->isSubscriber()) {
            return true;
        }
        return false;
    }

}
