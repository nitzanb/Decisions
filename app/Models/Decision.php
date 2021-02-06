<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decision extends Model
{
    use HasFactory;
    use SoftDeletes; //Won't delete a row from the DB, just add a timestamp at `deleted_at`

    public function user ()
    {
       return $this->belongsTo('App\user');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
