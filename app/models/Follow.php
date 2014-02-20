<?php

class Follow extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follow';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();
    
    public $timestamps = false;
}