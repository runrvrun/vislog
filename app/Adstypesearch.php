<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Adstypesearch extends Eloquent
{
    protected $guarded = ['id'];
}

// db.adstypesearches.createIndex( { "nadstype": 1 }, { unique: true } )