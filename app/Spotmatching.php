<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Spotmatching extends Eloquent
{
    protected $guarded = ['id'];
}