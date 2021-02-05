<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;

    public function user ()
    {
       return $this->belongsTo('App\user');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
