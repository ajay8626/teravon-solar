<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //use SoftDeletes;
    protected $table = 'projects';
    protected $primarykey = 'id';
    protected $fillable = [
        'name_of_client',
        'address', 
        'capacity_ac', 
        'capacity_dc', 
        'project_commissioned_on',
        'no_of_panels',
        'watt_peak',
        'category',
        'subcategory',
        'project_head',
        'maintenance_engg',
        'created_at'
    ];

    
}
