<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->unsignedInteger('article_type_id')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('image');
            $table->text('content');
            $table->text('excerpt');
            $table->unsignedInteger('rating')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('slug')->unique();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->foreign('market_id')
                ->references('id')
                ->on('markets');
                
            $table->foreign('article_type_id')
                ->references('id')
                ->on('article_types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
