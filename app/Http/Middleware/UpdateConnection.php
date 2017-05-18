<?php

namespace STS\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Contracts\Auth\Guard;

class UpdateConnection
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $user;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
<<<<<<< HEAD
        if (! \App::environment('testing')) {
            $this->auth = $auth;
            $this->user = $this->auth->parseToken()->authenticate();
        }
=======
        $this->auth = $auth;
        $this->user = $this->auth->parseToken()->authenticate();
>>>>>>> sts/develop
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->user) {
            $this->user->last_connection = Carbon::Now();
            $this->user->save();
        }

        return $next($request);
    }
}
