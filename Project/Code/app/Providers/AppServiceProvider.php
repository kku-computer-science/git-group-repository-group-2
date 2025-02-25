<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ตั้งค่าภาษาโดยใช้ session หรือค่าเริ่มต้น 'th'
        $locale = session('applocale', 'th'); // ถ้า session ไม่มี ค่าปริยายจะเป็น 'th'
    
        // ตรวจสอบว่า locale ที่ตั้งค่านั้นอยู่ในรายการภาษาที่รองรับหรือไม่
        if (array_key_exists($locale, config('languages'))) {
            App::setLocale($locale);
        }
    }
    
}
