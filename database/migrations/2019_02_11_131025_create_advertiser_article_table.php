<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_article', function (Blueprint $table) {
            $table->primary(['advertiser_id', 'article_id']);
            $table->unsignedInteger('advertiser_id');
            $table->unsignedInteger('article_id');

            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_article');
    }
}
