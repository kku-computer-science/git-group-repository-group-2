<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ตรวจสอบว่าภาษาอยู่ใน session หรือไม่
        $locale = Session::get('applocale', config('app.fallback_locale'));

        // ตั้งค่าภาษาในแอป
        App::setLocale($locale);

        return $next($request);
    }
}
