<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConferenceRoomNote extends Model
{
    use HasFactory;

    protected $table = 'ConferenceRoom_Notes'; // Tên bảng trong database
    
    public $timestamps = false;

    protected $fillable = ['id', 'code', 'content'];

    public function rooms()
    {
        return $this->hasMany(ConferenceRoom::class, 'note_code', 'code');
    }
    
}
