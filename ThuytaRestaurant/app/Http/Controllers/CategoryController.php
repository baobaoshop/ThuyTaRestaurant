<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:category',
            'name' => 'required',
            'img' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('img')?->store('categories', 'public');

        $enable = $request->has('enable') ? true : false;

        MenuCategory::create([
            'code' => $request->code,
            'name' => $request->name,
            'img' => $path,
            'enable' => $enable,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(MenuCategory $category)
    {
        return view('admin.categories.action', compact('category'));
    }

    public function update(Request $request, MenuCategory $category)
    {
        $request->validate([
            
            'name' => 'required',
            'img' => 'nullable|image|max:2048',
        ]);

        $path = $category->img;
        if ($request->hasFile('img')) {
            if ($category->img) {
                Storage::disk('public')->delete($category->img);
            }
            $path = $request->file('img')->store('categories', 'public');
        }
        $enable = $request->has('enable') ? true : false;

        $category->update([
            
            'name' => $request->name,
            'img' => $path,
            'enable' => $enable,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(MenuCategory $category)
    {
        if ($category->img) {
            Storage::disk('public')->delete($category->img);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
