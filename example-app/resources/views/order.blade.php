@extends('layouts.user')
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Home</a></span> / <span>Purchase Complete</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-sm-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>02</span></p>
                            <h3>Checkout</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>03</span></p>
                            <h3>Order Complete</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <p class="icon-addcart"><span><i class="icon-check"></i></span></p>
                    <h2 class="mb-4">Cảm ơn bạn đã mua hàng, Đơn hàng đã hoàn tất!</h2>
                    @if(session('new_order_id'))
                            <div class="alert alert-success" style="font-size: 18px; background: #d4edda; color: #155724; padding: 20px; border-radius: 5px; display: inline-block; margin: 20px 0;">
                                Mã đơn hàng của bạn là: <br>
                                <strong style="font-size: 30px;">#{{ session('new_order_id') }}</strong>
                            </div>
                            <p class="text-danger font-italic">
                                * Vui lòng ghi nhớ hoặc chụp lại <strong>Mã đơn hàng</strong> này để tra cứu tình trạng đơn hàng.
                            </p>

                            {{-- Nút chuyển sang trang Tra cứu --}}
                            <p>
                                <a href="{{ route('order.tracking') }}" class="btn btn-primary btn-outline">Tra cứu đơn hàng ngay</a>
                                <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
                            </p>
                        @else
                            {{-- Trường hợp khách F5 lại trang làm mất session mã đơn --}}
                            <div class="alert alert-info">
                                Đơn hàng của bạn đã được ghi nhận. Nếu bạn quên mã đơn hàng, vui lòng liên hệ Hotline để được hỗ trợ.
                            </div>
                            <p><a href="/" class="btn btn-primary">Về trang chủ</a></p>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection