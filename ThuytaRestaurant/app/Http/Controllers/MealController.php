<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Ingredient;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Dish::with('category', 'ingredients')->get();
        return view('admin.meals.index', compact('meals'));
    }

    public function create()
    {
        $categories = MenuCategory::all();
        $ingredients = Ingredient::all();
        return view('admin.meals.action', compact('categories', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dish_code' => 'required|unique:dish',
            'subname' => 'required',
            'dish_name' => 'required',
            'img' => 'nullable|image|max:2048',
            'content' => 'required',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'category_code' => 'required|exists:category,code',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredient,ingredient_code',
        ]);

        $path = $request->file('img')?->store('meal', 'public');

        $enable = $request->has('enable') ? true : false;

        $meal = Dish::create([
            'dish_code' => $request->input('dish_code'),
            'subname' => $request->input('subname'),
            'dish_name' => $request->input('dish_name'),
            'img' => $path,
            'content' => $request->input('content'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'category_code' => $request->input('category_code'),
            'enable' => $enable
        ]);
        if ($meal) {
            $meal->ingredients()->sync($request->input('ingredients'));
            return redirect()->route('meals.index')->with('success', 'Meal added successfully!');
        }
    }

    public function edit(Dish $meal)
    {
        $categories = MenuCategory::all();
        $ingredients = Ingredient::all();
        return view('admin.meals.action', compact('meal', 'categories', 'ingredients'));
    }

    public function update(Request $request, Dish $meal)
    {
        $request->validate([
            
            'subname' => 'required',
            'dish_name' => 'required',
            'img' => 'nullable|image|max:2048',
            'content' => 'required',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'category_code' => 'required|exists:category,code',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredient,ingredient_code',
        ]);

        $path = $meal->img;
        if ($request->hasFile('img')) {
            if ($meal->img) {
                Storage::disk('public')->delete($meal->img);
            }
            $path = $request->file('img')->store('introduction', 'public');
        }
        $enable = $request->has('enable') ? true : false;

        $meal->update([
            
            'subname' => $request->input('subname'),
            'dish_name' => $request->input('dish_name'),
            'img' => $path,
            'content' => $request->input('content'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'category_code' => $request->input('category_code'),
            'enable' => $enable
        ]);
        $meal->ingredients()->sync($request->input('ingredients'));

        return redirect()->route('meals.index')->with('success', 'Meal updated successfully!');
    }

    public function destroy(Dish $meal)
    {
        $meal->ingredients()->detach();
        $meal->delete();
        return redirect()->route('meals.index')->with('success', 'Meal deleted successfully!');
    }
}
