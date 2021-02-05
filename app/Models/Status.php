<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;
    use SoftDeletes; //Won't delete a row from the DB, just add a timestamp at `deleted_at`
    protected $fillable = ['id', 'name', 'description'];
}
