<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Targetaudience extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];    
}
