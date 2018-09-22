<?php

namespace FHusquinet\Seoable\Traits;

use Illuminate\Database\Eloquent\Builder;
use FHusquinet\Seoable\Models\SEOMetaData;

trait Seoable
{

    public function getMetaKeys()
    {
        return [
            'title',
            'description',
            'keywords',
            'og:title',
            'og:site_name',
            'og:description',
            'og:image',
            'og:url',
            'og:type'
        ];
    }

    public function getMeta($key, $default = null)
    {
        return $this->metas->{$key} ?? $default;
    }

    public function getMetas($keys = [])
    {
        $metas = [];
        foreach ( $keys as $key ) {
            $metas[$key] = $this->getMeta($key);
        }
        return $metas;
    }

    public function getAllMetas()
    {
        $metas = $this->getMetas(
            $this->getMetaKeys()
        );

        if ( ! method_exists($this, 'getDefaultMetas') ) {
            return $metas;
        }

        $defaults = $this->getDefaultMetas();
        foreach ( $metas as $key => $value ) {
            if ( empty($value) ) {
                $metas[$key] = $defaults[$key] ?? null;
            }
        }
        return $metas;
    }
    
    public function setMeta($meta, $value = '')
    {
        if ( ! is_array($meta) ) {
            $meta = [$meta => $value];
        }
        return SEOMetaData::updateOrCreate(
            ['model_id' => $this->id, 'model_type' => $this->getMorphClass()],
            $meta
        );
    }

    public function setMetas($metas = [])
    {
        return $this->setMeta($metas);
    }

    public function metas()
    {
        return $this->morphOne(SEOMetaData::class, 'model');
    }

}