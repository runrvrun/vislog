<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Commercial extends Eloquent
{
    protected $guarded = ['id'];
}