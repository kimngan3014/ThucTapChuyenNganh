<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductFrontendController extends Controller
{
    // 1. Hàm xem CHI TIẾT SẢN PHẨM
    public function show($id)
    {
        // Tìm sản phẩm, nếu không thấy thì báo lỗi 404
        $product = Product::findOrFail($id);
        
        // Trả về view 'product_sp' (file giao diện chi tiết của bạn)
        return view('product_sp', compact('product'));
    }
}