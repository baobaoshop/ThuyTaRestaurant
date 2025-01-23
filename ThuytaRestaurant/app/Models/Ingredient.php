<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'Ingredient'; 
    
    public $timestamps = false;

    protected $primaryKey = 'ingredient_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'ingredient_code', 'name'];

    public function dishes()
    {
        return $this->belongsToMany(
            Dish::class,
            'dish_ingredients', // Tên bảng pivot
            'ingredient_code',  // Khóa ngoại từ Ingredient
            'dish_code'         // Khóa ngoại từ Dish
        );
    }
    
    
}
