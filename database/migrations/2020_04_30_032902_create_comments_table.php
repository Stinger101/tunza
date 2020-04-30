<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string("comment")->nullable();//nullable in case of attachments
            $table->string("attachment_url")->nullable();//for questions e.g a pic of wheelchair, a video e.t.c
            $table->string("attachment_type")->nullable();// type of attachment i.e pdf to download, image, video
            $table->bigInteger("topic_id")->unsigned();
            $table->bigInteger("editor_id")->unsigned();
            $table->integer("visibility")->default(1);//1: public,2: by category,3: by user
            $table->foreign("editor_id")->references("id")->on("users");
            $table->foreign("topic_id")->references("id")->on("topics");
            $table->integer("is_answer")->default(0);//if this is 1 then close the topic, if remodified, open topic
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
        Schema::dropIfExists('comments');
    }
}
