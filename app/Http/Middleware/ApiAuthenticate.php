<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearer = $request->header('Bearer');
        if($bearer){
            $token = Token::where('token', $bearer)->first();
            if($token){
                $user = User::find($token->user_id);
                $request->user = $user;
                return $next($request);
            }
        }
        return response()->json(['error' => 'unauthenticated'], 401);
    }
}
