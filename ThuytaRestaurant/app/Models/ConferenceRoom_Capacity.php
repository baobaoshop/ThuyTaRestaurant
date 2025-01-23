<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConferenceRoom_Capacity extends Model
{
    use HasFactory;

    protected $table = 'ConferenceRoom_Capacity'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = [
        'room_code', 
        'capacity_code', 
        'quantity'
    ];


}
