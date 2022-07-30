<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\customerController;
use Illuminate\Support\Facades\Auth;

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
        $id = Auth::user()->id;
        $users = User::find($id);
        if($users->form_status == 1 ){
            session()->flash('error','Waiting For Approval');
            return redirect()->route('profile');

        }
        else if($users->form_status == 0){
            session()->flash('success','Please Complete The Profile !');
            return redirect()->route('profile');
           
        }
       else{
        return $next($request);
       }
    }
}
