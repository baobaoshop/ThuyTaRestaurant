<?php
// Create  
// Edit    --OK--
// Delete  
namespace App\Http\Controllers;

use App\Models\Introduction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    public function index()
    {
        $introductions = Introduction::all();
        return view('admin.introductions.index', compact('introductions'));
    }

    public function create()
    {
        return view('admin.introductions.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:introduction',
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('img')?->store('introductions', 'public');

        $enable = $request->has('enable') ? true : false;

        Introduction::create([
            'code' => $request->code,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'img' => $path,
            'enable' => $enable,
        ]);

        return redirect()->route('introductions.index')->with('success', 'introduction created successfully.');
    }

    public function edit(Introduction $introduction)
    {
        return view('admin.introductions.action', compact('introduction'));
    }

    public function update(Request $request, Introduction $introduction)
    {
        $request->validate([
            
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
            'img' => 'nullable|image|max:2048',
        ]);

        $path = $introduction->img;
        if ($request->hasFile('img')) {
            if ($introduction->img) {
                Storage::disk('public')->delete($introduction->img);
            }
            $path = $request->file('img')->store('introductions', 'public');
        }
        $enable = $request->has('enable') ? true : false;

        $introduction->update([
            
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'img' => $path,
            'enable' => $enable,
        ]);

        return redirect()->route('introductions.index')->with('success', 'introduction updated successfully.');
    }

    public function destroy(Introduction $introduction)
    {
        if ($introduction->img) {
            Storage::disk('public')->delete($introduction->img);
        }
        $introduction->delete();

        return redirect()->route('introductions.index')->with('success', 'introduction deleted successfully.');
    }
}
