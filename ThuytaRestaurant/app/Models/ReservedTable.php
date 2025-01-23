<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservedTable extends Model
{
    use HasFactory;

    protected $table = 'ReservedTable'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'code', 'name', 'enable'];

    public function gifts()
    {
        return $this->belongsToMany(Gift::class, 'gift_reservedtable', 'reservedtable_code', 'gift_code');
    }
    
}
