<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use App\Password_reset as SaftyQuestionConfirm;

class SaftyQuestion
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
        if(SaftyQuestionConfirm::where('username',auth()->user()->username)->first())
        {
            return $next($request);
        }
        else
        {
            return redirect("safetyQuestion")->with('success','برجاء اجابة سؤال الامان للمتابعة');
        }
        
    }
}
