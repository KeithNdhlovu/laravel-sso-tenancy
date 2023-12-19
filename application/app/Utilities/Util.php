<?php

namespace App\Utilities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Http;

class Util
{
    /**
     * Helper utilities will be added here to reduce code duplication.
     */
    public function __construct()
    {
    }

    /**
     * Default number of items that should be returned by a paginator.
     *
     * @return int
     */
    public static function defaultPerPage() : int
    {
        return 50;
    }

    /**
     * Default number of items that should be returned by a paginator.
     *
     * @return int
     */
    public static function defaultAppPerPage() : int
    {
        return 200;
    }

    /**
     * Filter out null keys on the array, and only return keys which have values.
     * ?Note: This function is mostly for us to be able to re-use request objects and only use inheritance to extend existing functionality.
     * @param array $payload
     * @return array
     */
    public static function filterNullKeys(array $payload): array
    {
        return collect($payload)->filter(function ($item) {
            return ! is_null($item);
        })->toArray();
    }

    /**
     * Send a message to discord for debugging purposes.
     *
     * @param mixed $payload
     * @return mixed
     */
    public static function sendDiscordMessage(mixed $payload): mixed
    {
        $url = config('services.discord.webhook_url');

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post($url, [
            'content' => $payload,
        ])
          ->throw()
          ->json();

        return $response;
    }
}
