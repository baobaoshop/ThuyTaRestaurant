<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiftNote extends Model
{
    use HasFactory;

    protected $table = 'Gift_Notes'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'content'];
}
