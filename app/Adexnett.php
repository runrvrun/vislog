<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Adexnett extends Eloquent
{
    protected $guarded = ['id'];
}