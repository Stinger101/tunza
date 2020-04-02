<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    //
    protected $fillable=["name","date_of_birth","parent_id"];
}
