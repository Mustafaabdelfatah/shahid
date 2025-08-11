<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
class SetSanctumCookieExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Retrieve all cookies set in the response
        $cookies = $response->headers->getCookies();

        foreach ($cookies as $cookie) {
            if ($cookie->getName() === 'XSRF-TOKEN') {
                // Create a new cookie with the same properties but extended expiration
                $newXsrfCookie = cookie(
                    $cookie->getName(),
                    $cookie->getValue(),
                    43200, // 30 days in minutes
                    $cookie->getPath(),
                    $cookie->getDomain(),
                    $cookie->isSecure(),
                    $cookie->isHttpOnly(),
                    $cookie->isRaw(),
                    $cookie->getSameSite()
                );

                // Replace the existing cookie with the new one
                $response->headers->setCookie($newXsrfCookie);
            }
        }

        return $response;
    }
}
