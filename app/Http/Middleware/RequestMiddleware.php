<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\customerController;
class RequestMiddleware
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
        $users = User::all();
        if($users->form_status = 0){
            return redirect()->route('profile')->with('success','Please Complete The Profile First!');

        }
        else if($users->form_status = 1){
     
            session()->flash('error','Waiting For Approval');
            return redirect()->route('profile');
        }
       else{
        return $next($request);
       }
    }
}
