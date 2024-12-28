<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConferenceRoomPromotion extends Model
{
    use HasFactory;

    protected $table = 'ConferenceRoom_Promotions'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'name', 'enable'];
}
