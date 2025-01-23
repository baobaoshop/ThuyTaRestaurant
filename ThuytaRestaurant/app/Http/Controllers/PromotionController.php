<?php
// Create  --OK--
// Edit    --OK--
// Delete  --OK--
namespace App\Http\Controllers;

use App\Models\BanquetHall;
use App\Models\ConferenceRoomPromotion;
use App\Models\Gift;
use App\Models\GiftNote;
use App\Models\ReservedTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function show(){
        $headerDatas = BanquetHall::where('enable', true)->get();


        $gifts = Gift::where('enable', true)->with('reservedTables')->get();
        $giftnotes = GiftNote::all();
        $tables = ReservedTable::where('enable', true)->get();
        $count = ReservedTable::where('enable', true)->count();

        
        return view('promotion.index', compact('headerDatas', 'gifts', 'giftnotes', 'tables', 'count'));
    }
    public function index()
    {
        $promotions = ConferenceRoomPromotion::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        $enable = $request->has('enable') ? true : false;

        ConferenceRoomPromotion::create([
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('promotions.index')->with('success', 'Promotion created successfully.');
    }

    public function edit(ConferenceRoomPromotion $promotion)
    {
        return view('admin.promotions.action', compact('promotion'));
    }

    public function update(Request $request, ConferenceRoomPromotion $promotion)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $enable = $request->has('enable') ? true : false;

        $promotion->update([
            'name' => $request->name,
            'enable' => $enable,
        ]);

        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(ConferenceRoomPromotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'promotion deleted successfully.');
    }
}
