<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    //

    protected $fillable=["is_active","invited_on","status","status_changed_on","is_registered",
    "email_provided","user_id","parent_id","child_id","category_id"];

    public function child(){
      return $this->belongsTo("App\Child","child_id");
    }
    public function parent(){
      return $this->belongsTo("App\User","parent_id");
    }
}
