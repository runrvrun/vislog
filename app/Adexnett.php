<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Adexnett extends Eloquent
{
    protected $guarded = ['id'];
    protected $dates = ['isodate'];

    protected $casts = [
        'grp' => 'float',
        'spots' => 'float',
        'gross' => 'integer',
        'revenue' => 'integer',
        'nett1' => 'float',
        'nett2' => 'float',
        'nett3' => 'float',
    ];
    
    public function setAttribute($key, $value)
    {
    if ($this->hasCast($key)) {
    $value = $this->castAttribute($key, $value);
    }
    return parent::setAttribute($key, $value);
    }
}