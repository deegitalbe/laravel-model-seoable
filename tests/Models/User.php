<?php

namespace FHusquinet\Seoable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use FHusquinet\Seoable\Traits\Seoable;

class User extends Model
{
    use Seoable;
    
    protected $guarded = [];

    public function getIdAttribute()
    {
        return 1;
    }
};