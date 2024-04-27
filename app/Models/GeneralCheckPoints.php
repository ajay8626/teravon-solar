<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralCheckPoints extends Model
{
    use SoftDeletes;
    protected $table = 'general_check_points';
    protected $primarykey = 'id';
    protected $fillable = ['category_id','sub_category_id','sr_no','check_points_question','frequency','status','remarks', 'created_at', 'updated_at', 'deleted_at'];

    const STATUS = [1 => 'Yes', 2 => 'No', 3 => 'Ok', 4 => 'Done'];
    const FREQUENCY = [1 => 'Weekly', 2 => 'Monthly', 3 => 'Half Yearly', 4 => 'Yearly'];
}
