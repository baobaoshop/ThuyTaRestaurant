<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::all();
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        return view('admin.gifts.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:gift',
            'name' => 'required',
        ]);


        $enable = $request->has('enable') ? true : false;

        Gift::create([
            'code' => $request->code,
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('gifts.index')->with('success', 'gift created successfully.');
    }

    public function edit(Gift $gift)
    {
        return view('admin.gifts.action', compact('gift'));
    }

    public function update(Request $request, Gift $gift)
    {
        $request->validate([
            
            'name' => 'required',
        ]);

        $enable = $request->has('enable') ? true : false;

        $gift->update([
            
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('gifts.index')->with('success', 'gift updated successfully.');
    }

    public function destroy(Gift $gift)
    {
        $gift->reservedTables()->detach();
        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'gift deleted successfully.');
    }
}
