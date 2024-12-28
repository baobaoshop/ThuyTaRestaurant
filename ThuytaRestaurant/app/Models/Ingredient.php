<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'Ingredient'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'code', 'name'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_ingredients', 'ingredient_code', 'dish_code');
    }
    
}
