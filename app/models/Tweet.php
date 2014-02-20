<?php

class Tweet extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();
    
    public function replies()
    {
        return $this->hasMany('Tweet');
    }
    
    public function author()
    {
        return $this->belongsTo('User');
    }
    
    public function retweet() {
        return $this->hasOne('Tweet', 'id', 'retweet_id');
    }
}