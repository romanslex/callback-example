<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid("widget_id");
            $table->integer("uid")->unsigned()->comment("Уникальный (среди всех регионов) id региона");
            $table->string("code");
            $table->string("name");
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
        Schema::table("regions", function($table){
            $table->dropForeign(['widget_id']);
        });
        Schema::dropIfExists('regions');
    }
}
