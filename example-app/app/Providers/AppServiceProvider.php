<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;
use App\Models\Setting; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('categories')) {
            $categories = Category::where('status', 1)->orderBy('name', 'ASC')->get();
            View::share('categories', $categories);
        }

        if (Schema::hasTable('settings')) {
            // Lấy tất cả settings và chuyển thành dạng mảng key => value
            // Kết quả sẽ giống: ['shop_phone' => '0905...', 'shop_address' => 'HCM']
            $settings = Setting::all()->pluck('config_value', 'config_key')->toArray();
            
            // Chia sẻ biến $globalSettings ra toàn bộ View
            View::share('globalSettings', $settings);
        }
    }
}
