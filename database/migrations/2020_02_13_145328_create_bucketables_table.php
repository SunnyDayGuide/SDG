<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBucketablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucketables', function (Blueprint $table) {
            $table->unsignedBigInteger('bucket_id');
            $table->morphs('bucketable');
            $table->text('notes')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->unique(['bucket_id', 'bucketable_id', 'bucketable_type']);

           // $table->primary(['bucket_id', 'bucketable_id', 'bucketable_type'], 'bucketable_index');
        });

        Schema::table('bucketables', function($table) {
           $table->foreign('bucket_id')->references('id')->on('buckets')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bucketables');
    }
}
