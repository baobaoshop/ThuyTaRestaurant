<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BanquetHall extends Model
{
    use HasFactory;

    protected $table = 'BanquetHall'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'hall_code', 'hall_name', 'date', 'enable'];

    public function contents()
    {
        return $this->hasMany(BanquetHallContent::class, 'hall_code', 'hall_code');
    }

}
