<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string("call_url");
            $table->dateTime("time_received")->nullable();//
            $table->dateTime("time_ended")->nullable();
            $table->bigInteger("caller_id")->unsigned();
            $table->bigInteger("receiver_id")->unsigned();
            $table->string("call_type");
            $table->foreign("caller_id")->references("id")->on("users");
            $table->foreign("receiver_id")->references("id")->on("users");
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
        Schema::dropIfExists('calls');
    }
}
