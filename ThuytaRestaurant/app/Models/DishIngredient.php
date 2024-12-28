<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DishIngredient extends Model
{
    use HasFactory;

    protected $table = 'Dish_infredients'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['dish_code', 'ingredient_code'];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_code', 'code');
    }
    
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_code', 'code');
    }
    
}
