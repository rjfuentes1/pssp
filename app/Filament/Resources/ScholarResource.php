<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScholarResource\Pages;
use App\Filament\Resources\ScholarResource\RelationManagers;
use App\Filament\Resources\ScholarResource\RelationManagers\EducationRelationManager;
use App\Filament\Resources\ScholarResource\RelationManagers\ReturnofserviceRelationManager;
use App\Models\Scholar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScholarResource extends Resource
{
    protected static ?string $model = Scholar::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('middlename')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('suffix')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('birthdate')
                    ->required(),
                Forms\Components\Select::make('sex')
                    ->options([
                        'MALE' => 'MALE',
                        'FEMALE' => 'FEMALE'
                    ])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('province')
                    ->options([
                        'AKLAN' => 'AKLAN',
                        'ANTIQUE' => 'ANTIQUE',
                        'CAPIZ' => 'CAPIZ',
                        'GUIMARAS' => 'GUIMARAS',
                        'ILOILO' => 'ILOILO',
                        'NEGROS OCCIDENTAL' => 'NEGROS OCCIDENTAL'
                    ])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('muncity')
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('email_address')
                    ->email()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('contact_number')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Complete Name')
                    ->searchable(['lastname', 'firstname'])
                    ->sortable(['lastname', 'firstname']),
                Tables\Columns\TextColumn::make('sex')
                    ->label('Sex')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('education.institution.name')
                    ->label('Educational Institution')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('education.course.name')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            EducationRelationManager::class,
            ReturnofserviceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScholars::route('/'),
            'create' => Pages\CreateScholar::route('/create'),
            'edit' => Pages\EditScholar::route('/{record}/edit'),
        ];
    }
}
