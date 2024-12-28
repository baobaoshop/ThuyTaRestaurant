<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiftReservedTable extends Model
{
    use HasFactory;

    protected $table = 'Gift_ReservedTable'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['reservedtable_code', 'gift_code'];

    public function reservedTable()
    {
        return $this->belongsTo(ReservedTable::class, 'reservedtable_code', 'code');
    }
    
    public function gift()
    {
        return $this->belongsTo(Gift::class, 'gift_code', 'code');
    }
    
}
