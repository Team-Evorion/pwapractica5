<?php

namespace App\Http\Middleware;

use App\RoleName;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roleKeys): Response
    {
        $user = $request->user();

        abort_if($user === null, Response::HTTP_UNAUTHORIZED);

        $allowedRoles = array_filter(array_map(
            fn (string $roleKey): ?RoleName => RoleName::tryFromKey($roleKey),
            $roleKeys,
        ));

        abort_unless(
            collect($allowedRoles)->contains(fn (RoleName $role): bool => $user->hasRole($role)),
            Response::HTTP_FORBIDDEN,
        );

        return $next($request);
    }
}
