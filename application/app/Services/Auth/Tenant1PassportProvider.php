<?php

namespace App\Services\Auth;

class Tenant1PassportProvider extends DynamicPassportProvider
{
    /**
     * Default parent provider name.
     *
     * @var string
     */
    protected $defaultProvider = 'laravelpassport.t1';
}
