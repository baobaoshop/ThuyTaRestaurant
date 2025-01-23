<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BanquetHallController extends Controller
{
    public function index()
    {
        $banquet_halls = BanquetHall::with('contents')->get();
        return view('admin.banquethalls.index', compact('banquet_halls'));
    }

    public function create()
    {
        return view('admin.banquethalls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hall_code' => 'required|string|max:255|unique:banquethall,hall_code',
            'hall_subname' => 'required|string|max:255',
            'hall_name' => 'required|string|max:255',
        ]);

        $enable = $request->has('enable') ? true : false;

        BanquetHall::create([
            'hall_code' => $request->hall_code,
            'hall_subname' => $request->hall_subname,
            'hall_name' => $request->hall_name,
            'date' => Carbon::now()->format('Y-m-d'),
            'enable' => $enable,
        ]);

        return redirect()->route('banquet_halls.index')->with('success', 'Banquet Hall created successfully!');
    }

    public function edit(BanquetHall $banquetHall)
    {
        $contents = $banquetHall->contents->sortBy('content_order');
        return view('admin.banquethalls.edit', compact('banquetHall', 'contents'));
    }

    public function update(Request $request, BanquetHall $banquetHall)
    {
         $request->validate([
            
            'hall_subname' => 'required|string|max:255',
            'hall_name' => 'required|string|max:255',
        ]);
        $enable = $request->has('enable') ? true : false;

        $banquetHall->update([
            'hall_subname' => $request->hall_subname,
            'hall_name' => $request->hall_name,
            'date' => Carbon::now()->format('Y-m-d'),
            'enable' => $enable,
        ]);


        return redirect()->route('banquet_halls.index')->with('success', 'Banquet Hall updated successfully!');
    }

    public function destroy(BanquetHall $banquetHall)
    {
        $banquetHall->contents()->delete();
        $banquetHall->delete();
        return redirect()->route('banquet_halls.index')->with('success', 'Banquet Hall deleted successfully!');
    }
}
