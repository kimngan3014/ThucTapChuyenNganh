@extends('layouts.user')

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Trang chủ</a></span> / <span>Liên hệ</span></p>
                </div>
            </div>
        </div>
    </div>

    <div id="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Thông tin liên hệ</h3>
                    <div class="row contact-info-wrap">
                        {{-- THÔNG TIN SHOP --}}
                        <div class="col-md-3">
                            <p>
                                <span><i class="icon-location"></i></span> 
                                {{ $settings['shop_address'] ?? 'Đang cập nhật địa chỉ' }}
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                <span><i class="icon-phone3"></i></span> 
                                <a href="tel://{{ $settings['shop_phone'] ?? '' }}">
                                    {{ $settings['shop_phone'] ?? 'Đang cập nhật SĐT' }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                <span><i class="icon-paperplane"></i></span> 
                                <a href="mailto:{{ $settings['shop_email'] ?? '' }}">
                                    {{ $settings['shop_email'] ?? 'Đang cập nhật Email' }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                <span><i class="icon-globe"></i></span> 
                                <a href="{{ $settings['shop_website'] ?? '/' }}">
                                    {{ $settings['shop_website'] ?? 'Website' }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="contact-wrap">
                        <h3>Gửi tin nhắn cho chúng tôi</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="icon-check"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row">
                                {{-- GỘP HỌ TÊN THÀNH 1 Ô --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fullname">Họ và Tên</label>
                                        <input type="text" name="fullname" class="form-control" placeholder="Nhập họ và tên của bạn" required>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email của bạn" required>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="subject">Tiêu đề</label>
                                        <input type="text" name="subject" class="form-control" placeholder="Bạn cần hỗ trợ vấn đề gì?" required>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">Nội dung tin nhắn</label>
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Viết nội dung..." required></textarea>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" value="Gửi tin nhắn" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection