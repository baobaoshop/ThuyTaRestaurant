<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomCapacity extends Model
{
    use HasFactory;

    protected $table = 'RoomCapacity'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'code', 
        'name', 
        'enable'
    ];

    public function conferenceRooms()
    {
        return $this->belongsToMany(ConferenceRoom::class, 'conferenceroom_capacity', 'capacity_code', 'room_code', 'code', 'code')
            ->withPivot('quantity');
    }
}
