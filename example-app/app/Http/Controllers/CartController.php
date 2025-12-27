<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartController extends Controller
{
    // 1. Thêm vào giỏ
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        if(!$product) { return redirect()->back(); }

        $cart = session()->get('cart', []);
        
        // Tạo key theo ID_SIZE
        $cartKey = $product->id . '_' . $request->size;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image,
                "size" => $request->size
            ];
        }

        session()->put('cart', $cart);
        // Chuyển hướng sang trang giỏ hàng
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');    
    }

    // 2. Hiển thị giỏ hàng
    public function showCart()
    {
        return view('cart'); 
    }

    // 3. Cập nhật (Dùng cho AJAX)
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    // 4. Xóa (Dùng cho nút X)
    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back();
    }

    public function buyNow(Request $request)
    {
        $product = Product::find($request->product_id);
        if(!$product) { return redirect()->back(); }

        $cartItem = [
            "product_id" => $product->id,
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "image" => $product->image,
            "size" => $request->size
        ];

        session()->put('buy_now_cart', [
            $product->id => $cartItem
        ]);

        return redirect()->route('checkout');
    }

    public function placeOrder(Request $request)
    {
        // 1. KIỂM TRA: Đang mua ngay hay mua từ giỏ hàng?
        if (session()->has('buy_now_cart')) {
            $cart = session()->get('buy_now_cart');
            $isBuyNow = true; 
        } else {
            $cart = session()->get('cart');
            $isBuyNow = false; 
        }

        if(!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // 2. Tính tổng tiền
        $total_money = 0;
        foreach($cart as $item) {
            $total_money += $item['price'] * $item['quantity'];
        }

        // 3. Lưu vào bảng 'orders'
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => auth()->id() ?? 0, 
            'fullname' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address') . ', ' . $request->input('city'),
            'note' => '',
            'total_money' => $total_money,
            'status' => 1,
            'payment_method' => $request->input('payment_method', 'COD'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // 4. Lưu chi tiết vào 'order_items'
        foreach($cart as $details) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_name' => $details['name'],
                'size' => $details['size'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // 5. Xóa session
        if ($isBuyNow) {
            session()->forget('buy_now_cart'); 
        } else {
            session()->forget('cart'); 
        }
        // 6. Chuyển hướng đến trang đơn hàng với thông báo
        return redirect()->route('order')->with('new_order_id', $orderId);
    }

    // --- HÀM MỚI THÊM ĐỂ HIỂN THỊ TRANG CẢM ƠN ---
    public function orderComplete()
    {
        return view('order');
    }
}