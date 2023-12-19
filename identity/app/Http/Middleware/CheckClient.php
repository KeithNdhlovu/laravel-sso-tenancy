<?php

namespace App\Http\Middleware;

use App\Models\Passport\Client;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $url = session('url.intended');
        
        if (!empty($url)) {
            // Get the client_id from the session
            $parseUrl = parse_url($url, PHP_URL_QUERY);
            // Get the parts
            parse_str($parseUrl, $params);
            $clientId = $params['client_id'];
            
            if (!$clientId) {
                return $next($request);
            }

            $cacheKey = 'client:' . $clientId;
            $client = cache()->rememberForever($cacheKey, function () use ($clientId) {
                return Client::find((string) $clientId);
            });

            if ($client?->custom) {
                $theme = $client->custom['theme'] ?? '';
                session(['client_theme' => $theme]);
            }
        }

        return $next($request);
    }
}
