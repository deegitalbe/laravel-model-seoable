<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoMetaDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_meta_datas', function (Blueprint $table) {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_meta_datas');
    }
}
