<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //
    protected $fillable=["call_url","time_received","time_ended","caller_id","receiver_id","call_type"];
}
