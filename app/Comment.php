<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=["comment","attachment_url","attachment_type","topic_id","editor_id","is_answer","visibility"];
    public function editor(){
      return $this->belongsTo("App\User","editor_id");
    }
}
