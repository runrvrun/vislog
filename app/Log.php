<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent; 

class Log extends Eloquent
{
    protected $guarded = ['id'];    
}
