<?php

class SportName extends \Eloquent {
    protected $table = 'sport_names';
    protected $fillable = ['name', 'approved'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsToMany('User', 'user_sport', 'name_id');
    }
    
    public function sport()
    {
        return $this->hasMany('sport', 'id');
    }
}