<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\RoomCapacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CapacityController extends Controller
{
    public function index()
    {
        $capacities = RoomCapacity::all();
        return view('admin.capacities.index', compact('capacities'));
    }

    public function create()
    {
        return view('admin.capacities.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:roomcapacity',
            'name' => 'required',
        ]);


        $enable = $request->has('enable') ? true : false;

        RoomCapacity::create([
            'code' => $request->code,
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('capacities.index')->with('success', 'Capacity created successfully.');
    }

    public function edit(RoomCapacity $capacity)
    {
        return view('admin.capacities.action', compact('capacity'));
    }

    public function update(Request $request, RoomCapacity $capacity)
    {
        $request->validate([
            
            'name' => 'required',
        ]);

        $enable = $request->has('enable') ? true : false;

        $capacity->update([
            
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('capacities.index')->with('success', 'Capacity updated successfully.');
    }

    public function destroy(RoomCapacity $capacity)
    {
       
        $capacity->delete();

        return redirect()->route('capacities.index')->with('success', 'Capacity deleted successfully.');
    }
}
