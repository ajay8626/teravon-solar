<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $table = 'sub_categories';
    public $primarykey = 'id';
    protected $fillable = ['category_id','sub_category_name', 'created_at', 'updated_at', 'deleted_at'];

    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    /*public function category() {
        return $this->belongsTo(Category::class);
    }*/
}
