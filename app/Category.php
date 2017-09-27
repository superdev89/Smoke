<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;

class Category extends Model
{
    protected $fillable = [
        'name',
        'order',
        'info',
    ];

    protected $table = 'categories';

    public function subcategories() {
        $subcategories = SubCategory::where('category_id', $this->id)->orderBy('order')->get();

        return $subcategories;
    }
}
