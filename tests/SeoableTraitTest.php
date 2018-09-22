<?php

namespace FHusquinet\Seoable\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use FHusquinet\Seoable\Tests\Models\User;
use FHusquinet\Seoable\Tests\Models\DefaultSeoUser;

use Auth;

class SeoableTraitTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->seoable = new User();
        $this->customizedSeoable = new DefaultSeoUser();
    }

    /**
     * @test
     */
    public function a_model_can_set_a_new_meta_data()
    {
        $this->seoable->setMeta('title', 'my meta title');

        $this->assertDatabaseHas('seo_meta_datas', [
            'model_id' => 1,
            'model_type' => $this->seoable->getMorphClass(),
            'title' => 'my meta title'
        ]);
    }

    /**
     * @test
     */
    public function a_model_can_set_a_new_meta_data_using_the_array_syntax()
    {
        $this->seoable->setMeta(['title' => 'my meta title']);

        $this->assertDatabaseHas('seo_meta_datas', [
            'model_id' => 1,
            'model_type' => $this->seoable->getMorphClass(),
            'title' => 'my meta title'
        ]);
    }

    /**
     * @test
     */
    public function a_model_can_update_an_existing_meta_data()
    {
        $this->seoable->setMeta('title', 'my meta title');
        $this->seoable->setMeta('title', 'my new meta title');

        $this->assertDatabaseMissing('seo_meta_datas', [
            'model_id' => 1,
            'model_type' => $this->seoable->getMorphClass(),
            'title' => 'my meta title'
        ]);
        $this->assertDatabaseHas('seo_meta_datas', [
            'model_id' => 1,
            'model_type' => $this->seoable->getMorphClass(),
            'title' => 'my new meta title'
        ]);
    }

    /**
     * @test
     */
    public function a_model_can_set_an_array_of_meta_datas_at_once()
    {
        $this->seoable->setMetas(['title' => 'my meta title', 'description' => 'my meta description']);

        $this->assertDatabaseHas('seo_meta_datas', [
            'model_id' => 1,
            'model_type' => $this->seoable->getMorphClass(),
            'title' => 'my meta title',
            'description' => 'my meta description'
        ]);
    }

    /**
     * @test
     */
    public function a_model_can_retrieve_one_of_its_meta()
    {
        $this->seoable->setMetas(['title' => 'my meta title', 'description' => 'my meta description']);

        $this->assertEquals(
            'my meta title',
            $this->seoable->getMeta('title')
        );
    }

    /**
     * @test
     */
    public function a_model_can_provide_a_default_value_in_case_the_meta_retrieved_doesnt_exist()
    {
        $this->seoable->setMetas(['description' => 'my meta description']);

        $this->assertEquals(
            'default',
            $this->seoable->getMeta('title', 'default')
        );
    }

    /**
     * @test
     */
    public function a_model_can_retrieve_multiple_of_its_meta()
    {
        $this->seoable->setMetas(['title' => 'my meta title', 'description' => 'my meta description', 'keywords' => 'test, one']);

        $this->assertEquals(
            ['title' => 'my meta title', 'description' => 'my meta description'],
            $this->seoable->getMetas(['title', 'description'])
        );
    }

    /**
     * @test
     */
    public function a_model_can_retrieve_all_of_its_meta()
    {
        $this->seoable->setMetas(['title' => 'my meta title', 'description' => 'my meta description', 'keywords' => 'test, one', 'og:description' => 'og description']);

        $this->assertEquals(
            [
                'title' => 'my meta title',
                'description' => 'my meta description',
                'keywords' => 'test, one',
                'og:title' => null,
                'og:site_name' => null,
                'og:description' => 'og description',
                'og:image' => null,
                'og:url' => null,
                'og:type' => null,
            ],
            $this->seoable->getAllMetas()
        );
    }

    /**
     * @test
     */
    public function a_model_can_set_default_metas_that_will_replace_null_values()
    {
        $this->customizedSeoable->setMetas(['description' => 'my meta description', 'keywords' => 'test, one', 'og:description' => 'og description']);

        $this->assertEquals(
            [
                'title' => 'default meta title',
                'description' => 'my meta description',
                'keywords' => 'test, one',
                'og:title' => null,
                'og:site_name' => null,
                'og:description' => 'og description',
                'og:image' => null,
                'og:url' => null,
                'og:type' => null,
            ],
            $this->customizedSeoable->getAllMetas()
        );
    }

    /**
     * @test
     */
    public function a_model_can_set_default_metas_that_will_replace_empty_values()
    {
        $this->customizedSeoable->setMetas(['title' => '', 'description' => 'my meta description', 'keywords' => 'test, one', 'og:description' => 'og description']);

        $this->assertEquals(
            [
                'title' => 'default meta title',
                'description' => 'my meta description',
                'keywords' => 'test, one',
                'og:title' => null,
                'og:site_name' => null,
                'og:description' => 'og description',
                'og:image' => null,
                'og:url' => null,
                'og:type' => null,
            ],
            $this->customizedSeoable->getAllMetas()
        );
    }
}