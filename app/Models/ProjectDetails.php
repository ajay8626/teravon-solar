<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetails extends Model
{
    //use SoftDeletes;
    protected $table = 'project_details';
    protected $primarykey = 'id';
    protected $fillable = ['company_name','address', 'capacity', 'project_date', 'categories_id', 'subcategories_id','updated_at', 'deleted_at'];

    
}
