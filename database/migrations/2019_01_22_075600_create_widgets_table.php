<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->integer("owner_id")->unsigned();
            $table->string("url");

            $table->datetime("rate_expired_at");

            $table->boolean("is_email_notify_enabled")->default(true);
            $table->text("emails");
            $table->boolean("is_sms_notify_enabled")->default(false);
            $table->text("phones");

            $table->string("timezone");

            $table->text("schedule");

            $table->boolean("is_displayed_during_not_working_hours")->default(false);
            $table->boolean("is_catch_enabled")->default(false);

            $table->boolean("is_autodisplay_enabled")->default(false);
            $table->integer("autodisplay_delay")->default(5);

            $table->boolean("is_displayed_in_all_regions")->default(true);

            $table->text("window_settings");
            $table->text("btn_settings");

            $table->text("mobile_window_settings");
            $table->text("mobile_btn_settings");

            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("widgets", function($table){
            $table->dropForeign(['owner_id']);
        });
        Schema::dropIfExists('widgets');
    }
}
