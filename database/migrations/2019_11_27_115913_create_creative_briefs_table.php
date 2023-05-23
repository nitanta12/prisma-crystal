<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreativeBriefsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_briefs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_id');
            $table->integer('creative_user_id');
            $table->string('creative_brief_name');
            $table->string('creative_brief_file');
            $table->text('creative_brief_description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('creative_briefs');
    }
}
