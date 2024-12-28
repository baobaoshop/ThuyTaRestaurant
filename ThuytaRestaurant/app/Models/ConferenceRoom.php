<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConferenceRoom extends Model
{
    use HasFactory;

    protected $table = 'ConferenceRoom'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'code', 
        'location', 
        'area', 
        'guest_theater', 
        'guest_table_10', 
        'guest_table_8', 
        'price_haft_day', 
        'price_full_day', 
        'note_code'
    ];

    public function note()
    {
        return $this->belongsTo(ConferenceRoomNote::class, 'note_code', 'code');
    }
    
}
