<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $res=session('userInfo');
        if($res==''){
            return redirect('login/login');
        }
//        //获取IP
//        $ip = $request->ip();
//        //获取时间
//        $date = date("Y-m-d H:i:s");
//        //获取访问路径
//        $url = $request->url();
//        //拼接ip,时间，内容
//        $str = $ip."在".$date."访问了".$url."\n\r";
//        //移动到指定路径
//        $filename = public_path().'/logs/'.date("ymd").".txt";
//        file_put_contents($filename,$str,FILE_APPEND);

        return $next($request);
    }
}
