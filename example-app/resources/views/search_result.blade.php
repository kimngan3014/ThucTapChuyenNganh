@extends('layouts.user')

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Trang chủ</a></span> / <span>Tìm kiếm</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                    <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>
                    <p>Tìm thấy {{ count($products) }} sản phẩm</p>
                </div>
            </div>

            {{-- HIỂN THỊ KẾT QUẢ --}}
            @if(count($products) > 0)
                <div class="row row-pb-md">
                    @foreach($products as $product)
                        <div class="col-lg-3 mb-4 text-center d-flex align-items-stretch">
                            <div class="product-entry h-100 d-flex flex-column" 
                                 style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 10px; overflow: hidden; width: 100%;">
                                
                                <a href="{{ route('product.detail', $product->id) }}" class="prod-img" 
                                   style="height: 240px; width: 100%; display: flex; align-items: center; justify-content: center; background: #f9f9f9;">
                                    @if(strpos($product->image, 'http') === 0)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                             style="max-height: 90%; max-width: 90%; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" 
                                             style="max-height: 90%; max-width: 90%; object-fit: contain;">
                                    @endif
                                </a>
                                
                                <div class="desc d-flex flex-column flex-grow-1 p-3">
                                    <h2 style="min-height: 44px; margin-bottom: 10px;">
                                        <a href="{{ route('product.detail', $product->id) }}" 
                                           style="font-weight: 600; color: #333; font-size: 15px; line-height: 22px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $product->name }}
                                        </a>
                                    </h2>
                                    
                                    <span class="price" style="color: #d9534f; font-weight: bold; font-size: 16px; display: block; margin-bottom: 15px;">
                                        {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                    </span>

                                    <div class="mt-auto w-100">
                                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-dark btn-block" 
                                           style="border-radius: 50px; padding: 8px; font-size: 14px; display: block; width: 100%;">
                                           <i class="icon-eye"></i> Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- TRƯỜNG HỢP KHÔNG TÌM THẤY --}}
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="text-muted">Rất tiếc, không tìm thấy sản phẩm nào phù hợp.</h3>
                        <p><a href="/" class="btn btn-primary">Quay lại trang chủ</a></p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection