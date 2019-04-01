<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->unsignedInteger('category_id');
            $table->string('offer');
            $table->string('suboffer')->nullable();
            $table->text('disclaimer')->nullable();
            $table->string('promo_code')->nullable();
            $table->string('barcode')->nullable();
            $table->text('barcode_type')->nullable();
            $table->unsignedInteger('logo_id')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('market_id')
                ->references('id')
                ->on('markets');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreign('logo_id')
                ->references('id')
                ->on('logos')
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
        Schema::dropIfExists('coupons');
    }
}
