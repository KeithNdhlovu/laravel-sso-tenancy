<?php

namespace App\Services\Auth;

use Exception;
use SocialiteProviders\LaravelPassport\Provider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class DynamicPassportProvider
{
    /**
     * The whitelisted providers in the system.
     *
     * @var string
     */
    public const PROVIDER_DEFAULT = 'laravelpassport.default';

    public const PROVIDER_T1 = 'laravelpassport.t1';

    public const PROVIDER_T2 = 'laravelpassport.t2';

    /**
     * Default parent provider name.
     *
     * @var string
     */
    protected $defaultProvider = self::PROVIDER_DEFAULT;

    /**
     * The whitelisted providers in the system.
     *
     * @var array
     */
    public const ALLOWED_PROVIDERS = [
        't1',
        't2',
    ];

    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite($this->defaultProvider, Provider::class);
    }

    /**
     * Determine the provider name from a given tenant id.
     *
     * @param string $tenantId
     * @return string
     */
    public static function getTenantDriver($tenantId)
    {
        // When there is no tenant id present, we can use the default driver
        if (is_null($tenantId)) {
            return 'laravelpassport.default';
        }

        if (! in_array($tenantId, self::ALLOWED_PROVIDERS)) {
            throw new Exception("The auth provider [{$tenantId}] is not supported at the moment.");
        }

        return "laravelpassport.{$tenantId}";
    }
}
