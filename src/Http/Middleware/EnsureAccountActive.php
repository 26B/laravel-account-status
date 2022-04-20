<?php

namespace TwentySixB\LaravelAccountStatus\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TwentySixB\LaravelAccountStatus\AccountStatus;
use TwentySixB\LaravelAccountStatus\Exceptions\AccountInactiveException;

class EnsureAccountActive
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
        $column           = config('account-status.model_column');
        $status_route     = config('account-status.route_name');
        $exception_routes = config('account-status.non_protected_routes', []);
        array_push($exception_routes, $status_route);

        if (in_array($request->route()?->getName(), $exception_routes, true)) {
            return $next($request);
        }

        if (Auth::guest()) {
            return $next($request);
        }

        if (Auth::user()->$column === AccountStatus::ACTIVE) {
            return $next($request);
        }

        $account_status = Auth::user()->$column;

        throw new AccountInactiveException(
            $account_status,
            __('Access is disabled'),
            403,
        );
    }
}
