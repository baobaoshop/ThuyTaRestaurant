<?php

namespace App\Http\Controllers;

use App\Models\ConferenceRoom;
use App\Models\ConferenceRoom_Capacity;
use App\Models\ConferenceRoomNote;
use App\Models\RoomCapacity;
use Illuminate\Http\Request;

class ConferenceRoomController extends Controller
{
    public function index()
    {
        $rooms = ConferenceRoom::with('note', 'capacities')->get();
        $notes = ConferenceRoomNote::all();
        $capacities = RoomCapacity::where('enable', 1)->get();
        return view('admin.conferences.index', compact('rooms', 'notes', 'capacities'));
    }

    // Form tạo mới
    public function create()
    {
        $notes = ConferenceRoomNote::all();
        $capacities = RoomCapacity::where('enable', 1)->get();
        return view('admin.conferences.action', compact('notes', 'capacities'));
    }

    // Lưu dữ liệu mới
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:conferenceroom,code',
            'location' => 'required',
            'area' => 'required|numeric',
            'guest_theater' => 'nullable|integer',
            'price_haft_day' => 'nullable|numeric',
            'price_full_day' => 'nullable|numeric',
        ]);

        $room = ConferenceRoom::create($request->only([
            'code', 'location', 'area', 'guest_theater', 'price_haft_day', 'price_full_day', 'note_code'
        ]));

        if ($request->has('capacities')) {
            foreach ($request->capacities as $capacity_code => $quantity) {
                // Bỏ qua nếu capacity_code hoặc quantity không hợp lệ (null hoặc rỗng)
                if ($capacity_code && $quantity !== null && $quantity !== '') {
                    ConferenceRoom_Capacity::create([
                        'room_code' => $room->code,
                        'capacity_code' => $capacity_code,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }
        

        return redirect()->route('conferences.index')->with('success', 'Phòng hội nghị được tạo thành công.');
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $room = ConferenceRoom::with('capacities')->findOrFail($id);
        $notes = ConferenceRoomNote::all();
        $capacities = RoomCapacity::where('enable', 1)->get();

        return view('admin.conferences.action', compact('room', 'notes', 'capacities'));
    }

    // Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $room = ConferenceRoom::findOrFail($id);

        $request->validate([
            
            'location' => 'required',
            'area' => 'required|numeric',
            'guest_theater' => 'nullable|integer',
            'price_haft_day' => 'nullable|numeric',
            'price_full_day' => 'nullable|numeric',
        ]);

        $room->update($request->only([
             'location', 'area', 'guest_theater', 'price_haft_day', 'price_full_day', 'note_code'
        ]));

        // Cập nhật capacities
        ConferenceRoom_Capacity::where('room_code', $room->code)->delete();
        if ($request->has('capacities')) {
            foreach ($request->capacities as $capacity_code => $quantity) {
                // Bỏ qua nếu capacity_code hoặc quantity không hợp lệ (null hoặc rỗng)
                if ($capacity_code && $quantity !== null && $quantity !== '') {
                    ConferenceRoom_Capacity::create([
                        'room_code' => $room->code,
                        'capacity_code' => $capacity_code,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }

        return redirect()->route('conferences.index')->with('success', 'Cập nhật phòng hội nghị thành công.');
    }

    // Xóa phòng hội nghị
    public function destroy($id)
    {
        $room = ConferenceRoom::findOrFail($id);
        ConferenceRoom_Capacity::where('room_code', $room->code)->delete();
        $room->delete();

        return redirect()->route('conferences.index')->with('success', 'Phòng hội nghị đã được xóa.');
    }
}
