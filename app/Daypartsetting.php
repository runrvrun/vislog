<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Daypartsetting extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];    
}
