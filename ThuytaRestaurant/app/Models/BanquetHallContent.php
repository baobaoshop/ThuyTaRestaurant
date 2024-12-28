<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BanquetHallContent extends Model
{
    use HasFactory;

    protected $table = 'BanquetHall_Contents'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'hall_code', 'type', 'subtype', 'content', 'content_order'];

    public function hall()
    {
        return $this->belongsTo(BanquetHall::class, 'hall_code', 'hall_code');
    }
    
}
