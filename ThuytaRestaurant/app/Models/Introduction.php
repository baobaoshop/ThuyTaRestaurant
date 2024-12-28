<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Introduction extends Model
{
    use HasFactory;

    protected $table = 'Introduction'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'code'. 'title', 'subtitle', 'content', 'img', 'enable'];
}
