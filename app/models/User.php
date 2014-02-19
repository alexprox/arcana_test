<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('pass');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->pass;
    }
    
    public function tweets() {
        return $this->hasMany('Tweet', 'author_id');
    }
    
    public function followers() {
        return $this->belongsToMany('User', 'follow', 'followed_id', 'follower_id');
    }

    public function following() {
        return $this->belongsToMany('User', 'follow', 'follower_id', 'followed_id');
    }
}
