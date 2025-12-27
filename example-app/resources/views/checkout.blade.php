@extends('layouts.user')

@section('body')
    {{-- 1. XỬ LÝ LOGIC: CHỌN GIỎ HÀNG NÀO ĐỂ HIỂN THỊ --}}
    @php
        // Nếu có session 'buy_now_cart' (khách vừa bấm Mua Ngay) -> Lấy giỏ đó
        if (session()->has('buy_now_cart')) {
            $cart = session('buy_now_cart');
        } 
        // Ngược lại -> Lấy giỏ hàng thường
        else {
            $cart = session('cart', []);
        }

        // Tính lại tổng tiền dựa trên giỏ hàng đã chọn
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    @endphp
    {{-- KẾT THÚC LOGIC --}}

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Home</a></span> / <span>Checkout</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-sm-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Checkout</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Order Complete</h3>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" action="{{ route('cart.placeOrder') }}" class="colorlib-form">
                @csrf
                
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Thông tin giao hàng</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Họ & Tên đệm</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Nhập họ..." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Tên</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Nhập tên..." required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ nhận hàng</label>
                                    <input type="text" name="address" class="form-control" placeholder="Số nhà, tên đường, phường/xã..." required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="towncity">Tỉnh / Thành phố</label>
                                    <input type="text" name="city" class="form-control" placeholder="Nhập tỉnh/thành phố..." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Ví dụ: 0912345678" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Địa chỉ Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Để nhận thông báo đơn hàng" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes">Ghi chú đơn hàng</label>
                                    <textarea name="notes" id="notes" cols="30" rows="5" class="form-control" placeholder="Ghi chú thêm về đơn hàng..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-detail">
                            <h2>Đơn hàng của bạn</h2>
                            <ul>
                                <li>
                                    <span>Sản phẩm</span>
                                    <span>Thành tiền</span>
                                </li>

                                {{-- 2. HIỂN THỊ SẢN PHẨM TỪ BIẾN $cart ĐÃ XỬ LÝ Ở TRÊN --}}
                                @if($cart)
                                    @foreach($cart as $details)
                                        @php 
                                            $subtotal = $details['price'] * $details['quantity'];
                                        @endphp
                                        <li>
                                            <span>
                                                {{ $details['quantity'] }} x {{ $details['name'] }} <br>
                                                <small>(Size: {{ $details['size'] }})</small>
                                            </span>
                                            <span>{{ number_format($subtotal) }} ₫</span>
                                        </li>
                                    @endforeach
                                @endif

                                <li>
                                    <span><strong>Tổng cộng</strong></span>
                                    <span><strong>{{ number_format($total) }} VNĐ</strong></span>
                                </li>
                            </ul>
                        </div>

                        <div class="cart-detail">
                            <h2>Phương thức thanh toán</h2>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" value="COD" checked> Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" value="BANK"> Chuyển khoản ngân hàng</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-block">Đặt hàng ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection