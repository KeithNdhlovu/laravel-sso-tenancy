<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Passport\Client;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define our scopes
        Passport::tokensCan([
            'maverick.admin' => 'Admin access',
            'maverick.user' => 'User access',
            'maverick.business.full_access' => 'Full Admin access for business',
            'maverick.business.read_only' => 'Read-only access for business',
        ]);

        // Using a custom Client model which allows us skipAuthorization
        Passport::useClientModel(Client::class);

        // Lessen the Token-Lifetime from 1 Year to 30 Days expiry
        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(60)); //@TODO: Disable refresh token lifetime expiry
        Passport::personalAccessTokensExpireIn(now()->addMonths(3));
    }
}
