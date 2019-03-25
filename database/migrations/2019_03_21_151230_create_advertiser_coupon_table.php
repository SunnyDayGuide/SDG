<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_coupon', function (Blueprint $table) {
            $table->primary(['advertiser_id', 'coupon_id']);
            $table->unsignedInteger('advertiser_id');
            $table->unsignedInteger('coupon_id');

            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
        Schema::dropIfExists('advertiser_coupon');
    }
}
