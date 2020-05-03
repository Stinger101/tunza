<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable=["topic","attachment_url","attachment_type","child_id","editor_id","visibility","status"];
    public function editor(){
      return $this->hasOne("App\User","editor_id");
    }
    public function comments(){
      return $this->hasMany("App\Comment","topic_id");
    }
}
