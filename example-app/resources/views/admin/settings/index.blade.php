@extends('layouts/admin')
@section('body')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Cấu hình thông tin Website</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số điện thoại Hotline</label>
                            <input type="text" name="shop_phone" class="form-control" 
                                   value="{{ $settings['shop_phone'] ?? '' }}" placeholder="Ví dụ: 0905.123.456">
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ cửa hàng</label>
                            <input type="text" name="shop_address" class="form-control" 
                                   value="{{ $settings['shop_address'] ?? '' }}" placeholder="Ví dụ: 123 Lê Lợi, Quận 1...">
                        </div>

                        <div class="form-group">
                            <label>Email liên hệ</label>
                            <input type="email" name="shop_email" class="form-control" 
                                   value="{{ $settings['shop_email'] ?? '' }}" placeholder="shopgiay@gmail.com">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Website (Link trang chủ)</label>
                            <input type="text" name="shop_website" class="form-control" 
                                   value="{{ $settings['shop_website'] ?? '' }}" placeholder="shopgiay.com">
                        </div>

                        <div class="form-group">
                            <label>Link Facebook Fanpage</label>
                            <input type="text" name="social_facebook" class="form-control" 
                                   value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                        </div>
                        
                        <div class="form-group">
                            <label>Link Twitter / Instagram</label>
                            <input type="text" name="social_twitter" class="form-control" 
                                   value="{{ $settings['social_twitter'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Lưu Cấu Hình</span>
                </button>
            </form>
        </div>
    </div>

</div>
@endsection