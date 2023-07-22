<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $request_role
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function handle(Request $request, Closure $next,string $request_role)
    {
        try {
            $token_id = trim(explode('|', explode('Bearer', $request->header('Authorization'))[1])[0]);
            $token = PersonalAccessToken::query()->where('id', $token_id)->firstOrFail();
            $user = User::query()->where('id', $token->tokenable_id)->firstOrFail();
            $role_id = $user->value('role_id');
            $role = Role::query()->where('id', $role_id)->firstOrFail();
            $compared_role = strtolower($request_role) === 'courier' ? \App\Enum\Role::COURIER : \App\Enum\Role::SET;
            throw_if(!$role->role_name === $compared_role, Exception::class);
        } catch (Throwable | Exception) {
            throw new Exception("invalid user role!");
        }
        return $next($request);
    }
}
