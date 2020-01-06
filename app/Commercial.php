<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Commercial extends Eloquent
{
    protected $guarded = ['id'];
}

// db.commercials.createIndex( { date: 1, nproduct: 1, start_video1: 1 }, { unique: true } )