<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Channel extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];    

    protected $casts = [
        'order' => 'integer',
    ];

    public function setAttribute($key, $value)
    {
    if ($this->hasCast($key)) {
    $value = $this->castAttribute($key, $value);
    }
    return parent::setAttribute($key, $value);
    }
}
