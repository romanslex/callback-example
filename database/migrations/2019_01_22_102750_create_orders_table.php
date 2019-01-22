<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid("widget_id");
            $table->string("phone");
            $table->timestamps();

            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("orders", function($table){
            $table->dropForeign(['widget_id']);
        });
        Schema::dropIfExists('orders');
    }
}
