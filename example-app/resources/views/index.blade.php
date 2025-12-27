@extends('layouts.user')
@section('body')
    <aside id="colorlib-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(images/img_bg_1.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Men's</h1>
                                        <h2 class="head-2">Shoes</h2>
                                        <h2 class="head-3">Collection</h2>
                                        <p class="category"><span>New trending shoes</span></p>
                                        <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(images/img_bg_2.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Huge</h1>
                                        <h2 class="head-2">Sale</h2>
                                        <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                        <p class="category"><span>Big sale sandals</span></p>
                                        <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(images/img_bg_3.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">New</h1>
                                        <h2 class="head-2">Arrival</h2>
                                        <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
                                        <p class="category"><span>New stylish shoes for men</span></p>
                                        <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <div class="colorlib-intro">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted
                        myself.</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="#" class="featured-img" style="background-image: url(images/men.jpg);"></a>
                        <div class="desc">
                            <h2><a href="#">Shop Men's Collection</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="#" class="featured-img" style="background-image: url(images/women.jpg);"></a>
                        <div class="desc">
                            <h2><a href="#">Shop Women's Collection</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                    <h2>Best Sellers</h2>
                </div>
            </div>

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
            {{-- <div class="row">
                <div class="col-md-12 text-center">
                    <p><a href="#" class="btn btn-primary btn-lg">Shop All Products</a></p>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="colorlib-partner">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                    <h2>Trusted Partners</h2>
                </div>
            </div>
            <div class="row">
                <div class="col partner-col text-center">
                    <img src="images/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="images/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="images/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="images/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="images/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
            </div>
        </div>
    </div>
@endsection