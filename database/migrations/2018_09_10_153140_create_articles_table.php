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
            $table->string('title');
            $table->string('author');
            $table->string('image')->nullable();
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->unsignedInteger('article_type_id')->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('rating')->default('0');
            $table->string('slug');
            $table->boolean('archived')->default(false);
            $table->timestamp('published_at')->nullable();
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
