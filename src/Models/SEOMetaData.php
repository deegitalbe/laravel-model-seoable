<?php

namespace FHusquinet\Seoable\Models;

use Illuminate\Database\Eloquent\Model;

class SEOMetaData extends Model
{
    public $table = 'seo_meta_datas';

    protected $guarded = [];

    public function model()
    {
        return $this->morphTo();
    }
}
