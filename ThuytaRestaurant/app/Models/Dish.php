<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'Dish'; 
    
    public $timestamps = false;

    protected $primaryKey = 'dish_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 
        'dish_code', 
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
        return $this->belongsToMany(
            Ingredient::class,
            'dish_ingredients', // Tên bảng pivot
            'dish_code',        // Khóa ngoại từ Dish
            'ingredient_code'   // Khóa ngoại từ Ingredient
        );
    }

    
}
