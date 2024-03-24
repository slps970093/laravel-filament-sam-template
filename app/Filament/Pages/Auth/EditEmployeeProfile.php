<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Pages\Auth\EditProfile;
use Filament\Tables\Columns\TextColumn;

class EditEmployeeProfile extends EditProfile
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('account')
                            ->required()
                            ->unique()
                            ->maxLength(255),
                        $this->getNameFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        FileUpload::make('avatar')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('200')
                    ])
                    ->operation('edit')
                    ->model($this->getUser())
                    ->statePath('data')
                    ->inlineLabel(! static::isSimple()),
            ),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ( empty($data['avatar']) ) {
            $data['avatar'] = '';
        }

        return $data;
    }
}
