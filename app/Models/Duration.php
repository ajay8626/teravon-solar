<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $table = 'durations';
    protected $primarykey = 'id';
    protected $fillable = ['duration', 'created_at', 'updated_at'];
}
