@extends('layouts.user')

@section('body')
{{-- Phần tiêu đề danh mục --}}
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="/">Trang chủ</a></span> / <span>{{ $category->name ?? 'Danh mục' }}</span></p>
            </div>
        </div>
    </div>
</div>

<div class="breadcrumbs-two">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumbs-img" style="background-image: url('{{ asset('images/cover-img-1.jpg') }}');">
                    <h2>{{ $category->name ?? 'Sản phẩm' }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Phần hiển thị danh sách sản phẩm --}}
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Xem tất cả sản phẩm</h2>
            </div>
        </div>
        
        {{-- BẮT ĐẦU PHẦN GIAO DIỆN MỚI --}}
        <div class="row row-pb-md">
            @if(isset($products) && count($products) > 0)
                @foreach ($products as $product)
                    {{-- Sử dụng col-lg-4 để chia 3 cột (giống trang chủ) --}}
                    <div class="col-lg-4 mb-4 text-center d-flex align-items-stretch">
                        <div class="product-entry h-100 d-flex flex-column" 
                             style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 10px; overflow: hidden; width: 100%;">
                            
                            {{-- 1. ẢNH SẢN PHẨM --}}
                            <a href="{{ route('product.detail', $product->id) }}" class="prod-img" 
                               style="height: 260px; width: 100%; display: flex; align-items: center; justify-content: center; background: #f9f9f9;">
                                @if(strpos($product->image, 'http') === 0)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                         style="max-height: 90%; max-width: 90%; object-fit: contain;">
                                @else
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" 
                                         style="max-height: 90%; max-width: 90%; object-fit: contain;">
                                @endif
                            </a>
                            
                            {{-- 2. THÔNG TIN & NÚT BẤM --}}
                            <div class="desc d-flex flex-column flex-grow-1 p-3">
                                
                                <h2 style="min-height: 44px; margin-bottom: 10px;">
                                    <a href="{{ route('product.detail', $product->id) }}" 
                                       style="font-weight: 600; color: #333; font-size: 16px; line-height: 22px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                
                                <span class="price" style="color: #d9534f; font-weight: bold; font-size: 18px; display: block; margin-bottom: 15px;">
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                </span>

                                {{-- Nút Xem chi tiết (Đẩy xuống đáy) --}}
                                <div class="mt-auto w-100">
                                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-dark btn-block" 
                                       style="border-radius: 50px; padding: 10px; display: block; width: 100%;">
                                       <i class="icon-eye"></i> Xem chi tiết
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>Hiện chưa có sản phẩm nào trong danh mục này.</p>
                </div>
            @endif
        </div>
        {{-- KẾT THÚC PHẦN GIAO DIỆN MỚI --}}

    </div>
</div>
@endsection