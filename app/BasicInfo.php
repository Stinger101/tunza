<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    //
    protected $fillable=["child_id","editor_id","topic","content","attachment","visibility"];

    public function child(){
      return $this->belongsTo("App\Child","child_id");
    }
}
