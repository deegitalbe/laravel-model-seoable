<?php

namespace FHusquinet\Seoable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use FHusquinet\Seoable\Traits\Seoable;

class DefaultSeoUser extends Model
{
    use Seoable;
    
    protected $guarded = [];

    public function getIdAttribute()
    {
        return 1;
    }

    public function getDefaultMetas()
    {
        return ['title' => 'default meta title', 'description' => 'default meta description'];
    }

}