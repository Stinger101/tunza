<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string("topic");//question
            $table->string("attachment_url")->nullable();//for questions e.g a pic of wheelchair, a video e.t.c
            $table->string("attachment_type")->nullable();// type of attachment i.e pdf to download, image, video
            $table->bigInteger("child_id")->unsigned();
            $table->bigInteger("editor_id")->unsigned();
            $table->integer("visibility")->default(1);//1: public,2: by category,3: by user
            $table->foreign("editor_id")->references("id")->on("users");
            $table->foreign("child_id")->references("id")->on("children");
            $table->integer("status")->default(0);//0: unanswered, 1: answered, 2: closed unanswered
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
        Schema::dropIfExists('topics');
    }
}
