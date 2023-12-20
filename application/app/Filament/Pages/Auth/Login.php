<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    /**
     * Override the form so we can show a slightly different UI to leverage the Identity Server
     * 
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * Override the Login button to navigate to the Identity Server
     *
     * @return \Filament\Actions\Action
     */
    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label(__('filament-panels::pages/auth/login.form.actions.authenticate.label'))
            ->url(fn (): string => route('login'));
    }
}