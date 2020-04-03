<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    //

    protected $fillable=["is_active","invited_on","status","status_changed_on","is_registered",
    "email_provided","user_id","parent_id","child_id","category_id"];
}