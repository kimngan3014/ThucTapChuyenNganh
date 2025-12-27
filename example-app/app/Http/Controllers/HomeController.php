<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
// 1. THÊM DÒNG NÀY: Để lấy dữ liệu từ bảng Setting
use App\Models\Setting; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        // Lấy sản phẩm
        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        
        // (Tùy chọn) Nếu bạn muốn hiện số điện thoại dưới chân trang chủ
        // thì mở comment dòng dưới ra nhé:
        // $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('index', compact('products'));
    }

    // 2. THÊM HÀM NÀY: Để hiển thị trang Liên Hệ với dữ liệu Setting
public function contact()
{
    // CÁCH MỚI: Lấy dòng đầu tiên trong bảng, nếu không có thì trả về mảng rỗng
    $data = Setting::first();

    // Chuyển thành mảng để bên View không bị lỗi
    if ($data) {
        $settings = $data->toArray();
    } else {
        $settings = [];
    }

    // Kiểm tra xem lấy được gì không (Debug) - Lát chạy xong nhớ xóa dòng này
    // dd($settings); 

    return view('contact', compact('settings'));
}

    public function viewCategory($id) 
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404);
        }

        $products = Product::where('idCategory', $id)->get();
        return view('category_user', compact('products', 'category'));
    }

    public function sendContact(Request $request)
    {
        DB::table('contacts')->insert([
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }

    public function tracking(Request $request)
    {
        $order = null;
        $items = [];

        if ($request->isMethod('post')) {
            $orderId = $request->input('order_id');
            $phone = $request->input('phone');

            $order = DB::table('orders')
                        ->where('id', $orderId)
                        ->where('phone', $phone)
                        ->first();

            if ($order) {
                $items = DB::table('order_items')->where('order_id', $orderId)->get();
            } else {
                session()->flash('error', 'Không tìm thấy đơn hàng! Vui lòng kiểm tra lại Mã đơn và SĐT.');
            }
        }

        return view('tracking', compact('order', 'items'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'like', "%{$keyword}%")->get();

        return view('search_result', compact('products', 'keyword'));
    }
}