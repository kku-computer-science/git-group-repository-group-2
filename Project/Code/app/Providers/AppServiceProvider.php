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
    Paginator::useBootstrap();

    // ตั้งค่าภาษาโดยใช้ session หรือค่าเริ่มต้น 'th'
    $locale = session('applocale', 'th'); // ถ้า session ไม่มี ค่าปริยายจะเป็น 'th'
    
    // ตรวจสอบว่า locale ที่ตั้งค่านั้นอยู่ในรายการภาษาที่รองรับหรือไม่
    if (array_key_exists($locale, Config::get('languages'))) {
        App::setLocale($locale);
    }

    // ส่งข้อมูลให้กับทุกๆ View ที่ใช้ layout 'layouts.layout'
    view()->composer(
        'layouts.layout', 
        function ($view) {
            $view->with('dn', \App\Models\Program::where('degree_id', '=', 1)->get());
        }
    );
}
}
