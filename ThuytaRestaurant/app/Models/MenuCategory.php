<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use HasFactory;

    protected $table = 'Category'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'code', 'name', 'img', 'enable'];

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'category_code', 'code');
    }
    
}
