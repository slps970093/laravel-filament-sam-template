<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseAuth;

class Employee extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form->schema([
            $this->getAccountFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
        ])
            ->statePath('data');
    }

    public function getAccountFormComponent()
    {
        return TextInput::make('account')
            ->label('account')
            ->required();
    }

    public function getCredentialsFromFormData(array $data): array
    {
        return [
            'account' => $data['account'],
            'password' => $data['password'],
        ];
    }
}
