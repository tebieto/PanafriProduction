<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('seller_id');
			$table->integer('buyer_id');
			$table->integer('shop_id');
			$table->integer('status')->nullable();
			$table->integer('delivery')->nullable();
			$table->text('location')->nullable();
			$table->integer('seller_status')->nullable();
			$table->integer('buyer_status')->nullable();
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
        Schema::dropIfExists('trackers');
    }
}
