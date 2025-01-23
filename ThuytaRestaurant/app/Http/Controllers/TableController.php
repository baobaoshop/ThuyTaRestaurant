<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\ReservedTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = ReservedTable::with('gifts')->get();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        $gifts = Gift::all();
        return view('admin.tables.action', compact('gifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:reservedtable',
            'name' => 'required',
            'gifts' => 'array',
            'gifts.*' => 'exists:gift,code',
        ]);

        $enable = $request->has('enable') ? true : false;

        $table = ReservedTable::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'enable' => $enable
        ]);
        if ($table) {
            $table->gifts()->sync($request->input('gifts'));
            return redirect()->route('tables.index')->with('success', 'Table added successfully!');
        }
    }

    public function edit(ReservedTable $table)
    {
        $gifts = Gift::all();
        return view('admin.tables.action', compact('table', 'gifts'));
    }

    public function update(Request $request, ReservedTable $table)
    {
        $request->validate([
            
            'name' => 'required',
            'gifts' => 'array',
            'gifts.*' => 'exists:gift,code',
        ]);

        $enable = $request->has('enable') ? true : false;

        $table->update([
            
            'name' => $request->input('name'),
            'enable' => $enable,
        ]);

        $table->gifts()->sync($request->input('gifts'));

        return redirect()->route('tables.index')->with('success', 'Table updated successfully!');
    }

    public function destroy(ReservedTable $table)
    {
        $table->gifts()->detach();
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Meal deleted successfully!');
    }
}
