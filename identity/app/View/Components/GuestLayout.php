<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // $url = session('url.intended');
        // if (!empty($url)) {
        //     // Get the client_id from the session
        //     $parseUrl = parse_url($url, PHP_URL_QUERY);
        //     // Get the parts
        //     parse_str($parseUrl, $params);

        //     dd($params);
        // }

        // dd("Gone");

        return view('layouts.guest')
            ->with('theme', '');
    }
}
