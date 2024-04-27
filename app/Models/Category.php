<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $fillable = ['name','parent_id', 'created_at', 'updated_at', 'deleted_at'];

   
    public function subcategories() {
        return $this->hasMany(SubCategory::class);
    }

    public function subcategory(){

        $subCat = $this->hasMany(SubCategory::class, 'category_id', 'id');
        return $subCat;
    }
    
}
