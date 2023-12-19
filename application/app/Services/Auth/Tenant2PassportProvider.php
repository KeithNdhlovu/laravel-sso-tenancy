<?php

namespace App\Services\Auth;

class Tenant2PassportProvider extends DynamicPassportProvider
{
    /**
     * Default parent provider name.
     *
     * @var string
     */
    protected $defaultProvider = 'laravelpassport.t2';
}
