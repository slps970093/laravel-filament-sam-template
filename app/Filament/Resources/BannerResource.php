<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationGroup = '網站';

    protected static ?string $navigationLabel = 'Banner 管理';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('app_language')
                    ->label('顯示語系')
                    ->options([
                        'zh_TW' => '繁體中文',
                        'en' => '英文'
                    ])
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('是否顯示')
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->image()
                    ->label('圖片')
                    ->required(),
                Forms\Components\TextInput::make('html_alt')
                    ->label('替代文字')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('app_language')
                    ->options([
                        'zh_TW' => '繁體中文',
                        'en' => '英文'
                    ])
                    ->label('顯示語系')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('是否顯示')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('圖片')
                    ->searchable(),
                Tables\Columns\TextColumn::make('html_alt')
                    ->label('替代文字')
                    ->searchable(),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
