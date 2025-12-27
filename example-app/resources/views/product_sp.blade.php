@extends('layouts.user')

@section('body')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="/">Home</a></span> / <span>Product Details</span></p>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg product-detail-wrap">
            
            <div class="col-sm-8">
                <div class="product-entry border">
                    <a href="#" class="prod-img" style="height: 500px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if(Str::startsWith($product->image, ['http://', 'https://']))
                            {{-- Ảnh Online --}}
                            <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}" 
                                style="width: 100%; max-height: 100%; object-fit: contain;">
                        @else
                            {{-- Ảnh Upload --}}
                            <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}" 
                                style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        @endif
                    </a>
                </div>
            </div>

            {{-- CỘT 2: THÔNG TIN CHI TIẾT --}}
            <div class="col-sm-4">
                <div class="product-desc">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">
                        <span style="font-size: 24px; color: #d9534f; font-weight: bold;">
                            {{ number_format($product->price, 0, ',', '.') }} VNĐ
                        </span> 
                        <span class="rate">
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-half"></i>
                            (74 Rating)
                        </span>
                    </p>
                    <p>Mã sản phẩm: <strong>#{{ $product->id }}</strong></p>
                    
                    {{-- FORM MUA HÀNG --}}
                    <form action="{{ route('cart.add') }}" method="POST"> 
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        {{-- 1. Khu vực chọn Size --}}
                        <div class="size-wrap">
                            <div class="block-26 mb-2">
                                <h4>Size</h4>
                                <ul>
                                    <li><a class="size-item" data-val="38">38</a></li>
                                    <li><a class="size-item" data-val="39">39</a></li>
                                    <li><a class="size-item" data-val="40">40</a></li>
                                    <li><a class="size-item" data-val="41">41</a></li>
                                    <li><a class="size-item" data-val="42">42</a></li>
                                </ul>
                                {{-- Input ẩn lưu size --}}
                                <input type="hidden" name="size" id="selected_size" value="" required>
                            </div>
                        </div>

                        {{-- 2. Khu vực chọn số lượng --}}
                        <div class="input-group mb-4">
                            <span class="input-group-btn">
                                <button type="button" class="quantity-left-minus btn" id="btn-minus">
                                    <i class="icon-minus2"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" style="text-align: center;">
                            <span class="input-group-btn ml-1">
                                <button type="button" class="quantity-right-plus btn" id="btn-plus">
                                    <i class="icon-plus2"></i>
                                </button>
                            </span>
                        </div>

                        {{-- 3. Nút Add to Cart & Buy Now --}}
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <p class="addtocart">
                                    <button type="submit" class="btn btn-primary btn-addtocart" onclick="return validateSize()">
                                        <i class="icon-shopping-cart"></i> Add to Cart
                                    </button>
                                    <button type="submit" class="btn btn-warning btn-addtocart btn-buy" formaction="{{ route('cart.buyNow') }}" onclick="return validateSize()">
                                        <i class="icon-flash"></i> Buy Now
                                    </button>
                                </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Phần mô tả sản phẩm --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                    <p class="p-3">{{ $product->description ?? 'Chưa có mô tả cho sản phẩm này.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT XỬ LÝ (Đã tối ưu gọn gàng) --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- 1. XỬ LÝ CHỌN SIZE ---
        const sizeLinks = document.querySelectorAll('.size-item');
        const sizeInput = document.getElementById('selected_size');

        sizeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Xóa class active ở tất cả các ô khác
                sizeLinks.forEach(item => item.classList.remove('active'));
                
                // Thêm class active vào ô vừa bấm
                this.classList.add('active');
                
                // Cập nhật giá trị vào input ẩn
                sizeInput.value = this.getAttribute('data-val');
            });
        });

        // --- 2. XỬ LÝ TĂNG GIẢM SỐ LƯỢNG ---
        const quantityInput = document.getElementById('quantity');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');

        // Nút Cộng
        btnPlus.addEventListener('click', function(){
            let currentVal = parseInt(quantityInput.value);
            if (!isNaN(currentVal)) {
                quantityInput.value = currentVal + 1;
            } else {
                quantityInput.value = 1;
            }
        });

        // Nút Trừ
        btnMinus.addEventListener('click', function(){
            let currentVal = parseInt(quantityInput.value);
            if (!isNaN(currentVal) && currentVal > 1) {
                quantityInput.value = currentVal - 1;
            } else {
                quantityInput.value = 1;
            }
        });

    });

    // --- 3. HÀM KIỂM TRA TRƯỚC KHI MUA ---
    function validateSize() {
        const sizeInput = document.getElementById('selected_size').value;
        if (!sizeInput) {
            alert("⚠️ Bạn ơi, nhớ chọn Size giày trước nha!");
            return false; // Chặn submit
        }
        return true; // Cho phép đi tiếp
    }
</script>

@endsection