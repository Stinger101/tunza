<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    //
    protected $fillable=["name","date_of_birth","parent_id"];

    public function caregivers(){
      return $this->hasMany("App\Caregiver","child_id");
    }
}
