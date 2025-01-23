<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gift extends Model
{
    use HasFactory;

    protected $table = 'Gift'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'code', 'name', 'enable'];

    public function reservedTables()
    {
        return $this->belongsToMany(ReservedTable::class, 'gift_reservedtable', 'gift_code', 'reservedtable_code');
    }
    
}
