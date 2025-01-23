<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('admin.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('admin.ingredients.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredient_code' => 'required|unique:ingredient',
            'name' => 'required',
        ]);

        Ingredient::create([
            'ingredient_code' => $request->ingredient_code,
            'name' => $request->name,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.action', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            
            'name' => 'required',
        ]);

        $ingredient->update([
            
            'name' => $request->name,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully.');
    }
}
