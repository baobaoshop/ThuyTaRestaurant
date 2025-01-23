<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use Illuminate\Http\Request;

class BanquetController extends Controller
{
    public function show($code)
    {
        $headerDatas = BanquetHall::where('enable', true)->get();


        $banquetHall = BanquetHall::where('hall_code', $code)->with(['contents' => function ($query) {
            $query->orderBy('content_order');
        }])->first();
        return view('banquet.index', compact('headerDatas', 'banquetHall'));
    }
}
