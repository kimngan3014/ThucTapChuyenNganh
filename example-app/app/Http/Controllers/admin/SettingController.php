<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // 1. Hiển thị Form nhập liệu
    public function index()
    {
        // Lấy toàn bộ setting từ DB
        $settings = Setting::all()->pluck('config_value', 'config_key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    // 2. Xử lý lưu dữ liệu khi bấm nút Save
    public function update(Request $request)
    {
        // Dữ liệu gửi lên dạng: ['shop_phone' => '090...', 'shop_email' => '...']
        $data = $request->except('_token'); // Lấy hết trừ token

        foreach ($data as $key => $value) {
            // Tìm dòng có config_key là $key, nếu chưa có thì tạo mới
            Setting::updateOrCreate(
                ['config_key' => $key],
                ['config_value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công!');
    }
}
