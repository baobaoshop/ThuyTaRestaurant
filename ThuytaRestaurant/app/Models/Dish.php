<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'Dish'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'code', 
        'category_code', 
        'dish_name', 
        'subname', 
        'content', 
        'min_price', 
        'max_price', 
        'img',
        'enable'
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_code', 'code');
    }
       
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'dish_ingredients', 'dish_code', 'ingredient_code');
    }
    
}
