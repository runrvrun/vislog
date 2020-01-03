<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Config extends Eloquent
{
    protected $guarded = ['id'];
}