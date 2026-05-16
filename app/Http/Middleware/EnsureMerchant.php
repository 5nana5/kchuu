<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureMerchant
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || ($user->role ?? 'user') !== 'merchant') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Merchant only.'], 403);
            }

            abort(403, 'Akses hanya untuk Merchant.');
        }

        return $next($request);
    }
}
