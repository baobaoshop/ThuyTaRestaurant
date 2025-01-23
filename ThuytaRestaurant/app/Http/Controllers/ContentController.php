<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use App\Models\BanquetHallContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function create($hall_code)
    {
        $banquethall = BanquetHall::where('hall_code', $hall_code)->firstOrFail();
        return view('admin.contents.create', compact('banquethall'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'hall_code' => 'required|string|max:255',
            'type' => 'required|string|in:text,img',
            'subtype' => 'nullable|string',
            'content' => 'required_if:type,text|string|max:500', // Content phải có nếu type là text
            'image' => 'required_if:type,img|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image phải có nếu type là img
        ]);
    
        // Lấy BanquetHall và tính thứ tự content mới
        $banquethall = BanquetHall::where('hall_code', $request->hall_code)->with('contents')->first();
        $lastContent = $banquethall->contents()->orderByDesc('content_order')->first();
        $contentCount = $lastContent ? $lastContent->content_order : 0;
        $contentCount += 1;
    
        // Xử lý content theo loại
        $contentValue = null;
        if ($request->type === 'text') {
            $contentValue = $request->content;
        } elseif ($request->type === 'img') {
            // Lưu ảnh vào storage và lấy đường dẫn
            $path = $request->file('image')?->store('contents', 'public');
            $contentValue = $path;
        }
    
        // Tạo nội dung mới
        BanquetHallContent::create([
            'hall_code' => $request->hall_code,
            'type' => $request->type,
            'subtype' => $request->subtype,
            'content' => $contentValue,
            'content_order' => $contentCount,
        ]);

        return redirect()->route('banquet_halls.edit', $banquethall->id)->with('success', 'Content added successfully!');
    }

    public function edit(BanquetHallContent $content)
    {
        
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hall_code' => 'required|string|max:255',
            'subtype' => 'nullable|string',
            'content' => 'required_if:type,text|string|max:500', // Content phải có nếu type là text
            'image' => 'required_if:type,img|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image phải có nếu type là img
        ]);
    
        // Lấy nội dung cần chỉnh sửa
        $content = BanquetHallContent::findOrFail($id);
    
        // Đảm bảo hall_code không bị thay đổi
        if ($content->hall_code !== $request->hall_code) {
            return redirect()->back()->withErrors(['hall_code' => 'Hall code không được phép thay đổi.']);
        }
    
        // Xử lý nội dung
        if ($content->type === 'text') {
            $content->update([
                'subtype' => $request->subtype,
                'content' => $request->content,
            ]);
        } elseif ($content->type === 'img') {
            $path = $content->img;
            if ($request->hasFile('image')) {
                if ($content->img) {
                    Storage::disk('public')->delete($content->img);
                }
                $path = $request->file('image')->store('contents', 'public');
            }
            $content->update([
                'content' => $path,
            ]);
        }

        $banquethall = BanquetHall::where('hall_code', $request->hall_code)->with('contents')->first();
        return redirect()->route('banquet_halls.edit', $banquethall->id)->with('success', 'Banquet Hall updated successfully!');
    }

    public function destroy(BanquetHallContent $content)
    {
        $banquethall = BanquetHall::where('hall_code', $content->hall_code)->with('contents')->first();
        $content->delete();
        return redirect()->route('banquet_halls.edit', $banquethall->id)->with('success', 'Content deleted successfully!');
    }
}
