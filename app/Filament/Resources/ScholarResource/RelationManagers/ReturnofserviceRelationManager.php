<?php

namespace App\Filament\Resources\ScholarResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturnofserviceRelationManager extends RelationManager
{
    protected static string $relationship = 'returnofservice';
    protected static ?string $title = 'Return of Service';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agreement'),
                Forms\Components\TextInput::make('board_take'),
                Forms\Components\Select::make('board_status')
                    ->options([
                        'PASSED' => 'PASSED',
                        'FAILED' => 'FAILED'
                    ]),
                Forms\Components\DatePicker::make('start_of_deployment'),
                Forms\Components\DatePicker::make('end_of_deployment'),
                Forms\Components\TextInput::make('remarks'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('scholar_id')
            ->columns([
                Tables\Columns\TextColumn::make('agreement'),
                Tables\Columns\TextColumn::make('board_take'),
                Tables\Columns\TextColumn::make('board_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'PASSED' => 'success',
                        'FAILED' => 'danger',
                        default => 'unknown'
                    }),
                Tables\Columns\TextColumn::make('start_of_deployment')
                    ->date(),
                Tables\Columns\TextColumn::make('end_of_deployment')
                    ->date(),
                Tables\Columns\TextColumn::make('remarks'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modalHeading('Add Return of Service Info'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalHeading('Return of Service Info'),
                    Tables\Actions\DeleteAction::make()->modalHeading('Delete Return of Service Info'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
