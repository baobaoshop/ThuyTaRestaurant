<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservedTable extends Model
{
    use HasFactory;

    protected $table = 'ReservedTable'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'code', 'name'];

    public function gifts()
    {
        return $this->belongsToMany(Gift::class, 'gift_reserved_tables', 'reservedtable_code', 'gift_code');
    }
    
}
