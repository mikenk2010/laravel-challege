<?php

namespace App\Domains\Auth\Http\Middleware;

use App\Domains\Auth\Models\User;
use Closure;

/**
 * Class LoanCheck.
 */
class LoanCheck
{
    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return redirect()->route('frontend.user.loan')->withFlashDanger(__('You can\'t apply more loan this time'));

        return $next($request);

    }
}
