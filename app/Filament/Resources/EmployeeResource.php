<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $navigationGroup = '後台管理';

    protected static ?string $navigationLabel = '管理員';

    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\TextInput::make('account')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('change_password')
                    ->label('變更密碼')
                    ->helperText('勾选此选项以更改密码。')
                    ->reactive()
                    ->hidden(fn ($livewire) => $livewire instanceof Pages\CreateEmployee), // Hide on create page
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn ($get) => $get('change_password') === true)
                    ->maxLength(255)
                    ->hidden(fn ($get) => $get('change_password') !== true),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('200')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active')
                    ->label('啟用狀態')
                    ->boolean(),
                Tables\Columns\TextColumn::make('account')
                    ->label('帳號')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('用戶名稱')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('頭像'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
