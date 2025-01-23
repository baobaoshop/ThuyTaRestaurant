<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use App\Models\ConferenceRoom;
use App\Models\ConferenceRoomPromotion;
use App\Models\RoomCapacity;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index(){
        $headerDatas = BanquetHall::where('enable', true)->get();


        $conferences = ConferenceRoom::with(['capacities', 'note'])
        ->orderBy('note_code') // Sắp xếp theo cột note_code
        ->get();

        $promotions = ConferenceRoomPromotion::where('enable', true)->get();
        $roomcapacities = RoomCapacity::where('enable', true)->get();
        $notesCount = $conferences->groupBy('note.content')->map->count();
        
        return view('conference.index', compact('headerDatas', 'conferences', 'promotions', 'roomcapacities', 'notesCount'));
    }
}
