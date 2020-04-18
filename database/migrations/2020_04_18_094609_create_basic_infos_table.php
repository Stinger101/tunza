<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("child_id")->unsigned();
            $table->bigInteger("editor_id")->unsigned();//editor
            $table->string("topic");
            // TODO: think about how this will work for images (whatsapp style is a good idea)
            $table->string("content");
            $table->string("attachment")->nullable();//id same to id of record: can be moved to its own table though
            $table->integer("visibility")->default(1);//1 public,2 private
            $table->foreign("editor_id")->references("id")->on("users");
            $table->foreign("child_id")->references("id")->on("children");
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
        Schema::dropIfExists('basic_infos');
    }
}
