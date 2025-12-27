@extends('layouts.user')

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Home</a></span> / <span>Shopping Cart</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center">
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

            <div class="row row-pb-lg">
                <div class="col-md-12">
                    <div class="product-name d-flex">
                        <div class="one-forth text-left px-4" style="width: 50%;">
                            <span>Product Details</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Price</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Quantity</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Total</span>
                        </div>
                        <div class="one-eight text-center px-4">
                            <span>Remove</span>
                        </div>
                    </div>

                    {{-- KIỂM TRA GIỎ HÀNG CÓ TRỐNG KHÔNG --}}
                    @if(session('cart'))
                        @php $total = 0; @endphp
                        
                        @foreach(session('cart') as $id => $details)
                            @php 
                                $subtotal = $details['price'] * $details['quantity'];
                                $total += $subtotal;
                            @endphp
                            
                            {{-- QUAN TRỌNG: Thêm data-id="{{ $id }}" để Javascript biết ID sản phẩm --}}
                            <div class="product-cart d-flex" data-id="{{ $id }}">
                                
                                {{-- ================================================= --}}
                                {{-- ĐOẠN ĐÃ ĐƯỢC CHỈNH SỬA LẠI GIAO DIỆN Ở ĐÂY --}}
                                {{-- ================================================= --}}
                                <div class="one-forth" style="display: flex; align-items: center; width: 50%;">
                                    
                                    {{-- 1. PHẦN ẢNH (Cố định size) --}}
                                    <div class="product-img" style="width: 90px; height: 90px; margin-right: 15px; flex-shrink: 0;">
                                        @if(Str::startsWith($details['image'], ['http://', 'https://']))
                                            <img src="{{ $details['image'] }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; display: block;">
                                        @else
                                            <img src="{{ asset('images/' . $details['image']) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; display: block;">
                                        @endif
                                    </div>

                                    {{-- 2. PHẦN THÔNG TIN (Đã bỏ display-tc và padding thừa) --}}
                                    <div style="text-align: left;">
                                        <h3 style="margin: 0 0 5px 0; font-weight: 600; font-size: 16px; line-height: 1.2;">
                                            {{ $details['name'] }}
                                        </h3>
                                        <p style="margin: 0; color: #888; font-size: 14px;">
                                            Size: <strong>{{ $details['size'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                                {{-- ================================================= --}}

                                <div class="one-eight text-center">
                                    <div class="display-tc">
                                        <span class="price">{{ number_format($details['price']) }} VNĐ</span>
                                    </div>
                                </div>
                                <div class="one-eight text-center">
                                    <div class="display-tc">
                                        {{-- Input số lượng --}}
                                        <input type="text" name="quantity" class="form-control input-number text-center" value="{{ $details['quantity'] }}" min="1" max="100">
                                    </div>
                                </div>
                                <div class="one-eight text-center">
                                    <div class="display-tc">
                                        <span class="price">{{ number_format($subtotal) }} VNĐ</span>
                                    </div>
                                </div>
                                <div class="one-eight text-center">
                                    <div class="display-tc">
                                        {{-- Nút xóa --}}
                                        <a href="{{ route('cart.remove', ['id' => $id]) }}" class="closed" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Nếu giỏ hàng trống --}}
                        <div class="text-center p-5">
                            <h3>Giỏ hàng của bạn đang trống!</h3>
                            <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
                        </div>
                    @endif

                </div>
            </div>

            {{-- CHỈ HIỆN PHẦN TỔNG TIỀN NẾU CÓ SẢN PHẨM --}}
            @if(session('cart'))
                <div class="row row-pb-lg">
                    <div class="col-md-12">
                        <div class="total-wrap">
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4 text-center">
                                    <div class="total">
                                        <div class="sub">
                                            <p><span>Subtotal:</span> <span>{{ number_format($total) }} VNĐ</span></p>
                                        </div>
                                        <div class="grand-total">
                                            <p><span><strong>Total:</strong></span> <span>{{ number_format($total) }} VNĐ</span></p>
                                        </div>
                                        <div class="mt-3">
                                             <a href="#" class="btn btn-primary btn-block">Thanh toán (Checkout)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- JAVASCRIPT XỬ LÝ CẬP NHẬT GIỎ HÀNG (AJAX) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Khi người dùng thay đổi số lượng trong ô input
            $(".input-number").change(function (e) {
                e.preventDefault();
                
                var ele = $(this);
                
                // Gửi Ajax lên server
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents(".product-cart").attr("data-id"), 
                        quantity: ele.val()
                    },
                    success: function (response) {
                        // Load lại trang để cập nhật số tiền
                        window.location.reload();
                    }
                });
            });
        });
    </script>

@endsection