<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaregiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_active");
            $table->dateTime("invited_on");
            $table->dateTime("accepted_on");
            $table->boolean("is_registered");
            $table->string("email_provided");
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("parent_id")->unsigned();
            $table->bigInteger("child_id")->unsigned();
            $table->bigInteger("category_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("parent_id")->references("id")->on("users");
            $table->foreign("child_id")->references("id")->on("children");
            $table->foreign("category_id")->references("id")->on("categories");
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
        Schema::dropIfExists('caregivers');
    }
}
