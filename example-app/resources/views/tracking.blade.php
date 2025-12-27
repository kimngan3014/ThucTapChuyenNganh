@extends('layouts.user')

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Trang chủ</a></span> / <span>Tra cứu đơn hàng</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            
            {{-- PHẦN 1: FORM TRA CỨU --}}
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="cart-detail" style="background: #f8f9fa; padding: 30px; border-radius: 10px; margin-bottom: 30px;">
                        <h2 class="text-center mb-4">Kiểm tra tình trạng đơn hàng</h2>
                        
                        {{-- Hiển thị thông báo lỗi nếu tìm không thấy --}}
                        @if(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('order.tracking') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="order_id">Mã đơn hàng (ID):</label>
                                <input type="number" name="order_id" class="form-control" placeholder="Ví dụ: 25" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại đặt hàng:</label>
                                <input type="text" name="phone" class="form-control" placeholder="Ví dụ: 0912345678" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block">Tra cứu ngay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- PHẦN 2: KẾT QUẢ HIỂN THỊ (Chỉ hiện khi tìm thấy đơn $order) --}}
            @if($order)
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-detail" style="background: #fff; padding: 20px; border: 1px solid #ddd;">
                        <h3 class="text-primary">Thông tin đơn hàng #{{ $order->id }}</h3>
                        
                        {{-- Thông tin chung --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Họ tên:</strong> {{ $order->fullname }}</p>
                                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                                <p><strong>SĐT:</strong> {{ $order->phone }}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
                                <p><strong>Trạng thái:</strong> 
                                    @if($order->status == 1) <span class="badge badge-warning">Chờ xử lý</span>
                                    @elseif($order->status == 2) <span class="badge badge-info">Đang giao</span>
                                    @elseif($order->status == 3) <span class="badge badge-success">Đã giao</span>
                                    @else <span class="badge badge-secondary">Đã hủy</span>
                                    @endif
                                </p>
                                <p><strong>Tổng tiền:</strong> <span style="color: red; font-weight: bold; font-size: 18px;">{{ number_format($order->total_money, 0, ',', '.') }} VNĐ</span></p>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <h4>Chi tiết sản phẩm</h4>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection