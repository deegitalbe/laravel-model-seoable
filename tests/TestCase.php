<?php

namespace FHusquinet\Seoable\Tests;

use FHusquinet\Seoable\Models\CampaignActivity;
use FHusquinet\Seoable\Tests\Models\User;
use Illuminate\Database\Schema\Blueprint;
use FHusquinet\Seoable\Tests\Models\Article;
use FHusquinet\Seoable\SeoableServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function checkRequirements()
    {
        parent::checkRequirements();

        collect($this->getAnnotations())->filter(function ($location) {
            return in_array('!Travis', array_get($location, 'requires', []));
        })->each(function ($location) {
            getenv('TRAVIS') && $this->markTestSkipped('Travis will not run this test.');
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            SeoableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => $this->getTempDirectory().'/database.sqlite',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
    }

    protected function changeDatabaseConnection($connection)
    {
        $this->app['config']->set('database.connections.default', $connection);
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();

        $this->createUsersTable();
        $this->createSeoMetaDatasTable();
    }

    protected function resetDatabase()
    {
        file_put_contents($this->getTempDirectory().'/database.sqlite', null);
    }

    public function getTempDirectory(): string
    {
        return __DIR__.'/temp';
    }

    protected function createUsersTable()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table)  {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->json('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    protected function createSeoMetaDatasTable()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('seo_meta_datas', function (Blueprint $table)  {
            $table->increments('id');
            $table->string('model_type')->nullable();
            $table->integer('model_id')->unsigned()->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('og:title')->nullable();
            $table->text('og:site_name')->nullable();
            $table->text('og:description')->nullable();
            $table->text('og:image')->nullable();
            $table->text('og:url')->nullable();
            $table->text('og:type')->nullable();
            $table->timestamps();
        });
    }

    public function doNotMarkAsRisky()
    {
        $this->assertTrue(true);
    }
}