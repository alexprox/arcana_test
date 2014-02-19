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
    protected $hidden = array('pass');
        
    public function reply_to()
    {
        return $this->belongsTo('Tweet');
    }
    
    public function author()
    {
        return $this->belongsTo('User');
    }
    
}
