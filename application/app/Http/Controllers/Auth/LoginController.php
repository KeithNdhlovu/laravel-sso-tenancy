<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\DynamicPassportProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Provider driver.
     *
     * @var \Laravel\Socialite\Contracts\Provider|null
     */
    private ?Provider $provider = null;

    /**
     * Controller instance.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the external auth servers page.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToExternalAuthServer(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $driver = DynamicPassportProvider::getTenantDriver(tenant('id'));

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleExternalAuthCallback(Request $request): RedirectResponse
    {
        $driver = DynamicPassportProvider::getTenantDriver(tenant('id'));
        
        // dd($request);
        // dd(Socialite::driver($driver));

        $user = Socialite::driver($driver)->user();
        
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before, return the user else, create a new user object.
     *
     * @param \Laravel\Socialite\Contracts\User $ssoUser
     * @return \App\Models\User
     */
    public function findOrCreateUser(\Laravel\Socialite\Contracts\User $ssoUser): User
    {
        // Return the user if it exists - provider ID is the IDP's user ID
        $authUser = User::where('id', $ssoUser->getId())->first();

        if ($authUser) {
            return $authUser;
        }

        $tmpSSOUser = $ssoUser->user;

        // Create new local user from the details we received from the IDP
        return User::create([
            'id' => $ssoUser->getId(),
            'email' => $ssoUser->getEmail(),
            'first_name' => $tmpSSOUser['first_name'],
            'last_name' => $tmpSSOUser['last_name'],
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
