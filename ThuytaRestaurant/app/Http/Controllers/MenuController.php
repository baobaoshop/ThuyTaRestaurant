<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\Dish;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $headerDatas = BanquetHall::where('enable', true)->get();


        // Lấy tất cả danh mục loại thực đơn kèm số lượng món ăn
        $categories = MenuCategory::withCount(['dishes' => function ($query) {
            $query->where('enable', true); // Chỉ đếm món ăn được bật
        }])->where('enable', true)->get();

        // Mặc định hiển thị món ăn của danh mục đầu tiên
        $firstCategory = $categories->first();
        $code = $firstCategory->code;
        $dishes = $firstCategory ? Dish::where('category_code', $firstCategory->code)
        ->where('enable', true)
        ->with('ingredients')
        ->get() : [];

        // Trả về view menu.index kèm dữ liệu
        return view('menu.index', compact('headerDatas', 'categories', 'dishes', 'code'));
    }

    public function show($code)
    {
        $headerDatas = BanquetHall::where('enable', true)->get();


        // Lấy tất cả danh mục
        $categories = MenuCategory::withCount(['dishes' => function ($query) {
            $query->where('enable', true); // Chỉ đếm món ăn được bật
        }])->where('enable', true)->get();

        // Lấy danh sách món ăn thuộc loại đã chọn
        $dishes = Dish::where('category_code', $code)
                    ->where('enable', true) // Chỉ lấy món ăn được bật
                    ->with('ingredients')
                    ->get();

        // Trả về view menu.index kèm dữ liệu
        return view('menu.index', compact('headerDatas', 'categories', 'dishes', 'code'));
    }

}
