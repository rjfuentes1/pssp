<?php

namespace App\Filament\Resources\ScholarResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EducationRelationManager extends RelationManager
{
    protected static string $relationship = 'education';
    protected static ?string $title = 'Education';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('institution_id')
                    ->label('Educational Institution')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('institution', 'name'),
                Forms\Components\Select::make('course_id')
                    ->label('Course Name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->relationship('course', 'name'),
                Forms\Components\TextInput::make('year_of_acceptance')
                    ->label('Year of Acceptance'),
                Forms\Components\TextInput::make('year_of_ending')
                    ->label('Year of Ending'),
                Forms\Components\TextInput::make('do_number')
                    ->label('Department Order No.'),
                Forms\Components\Select::make('remarks')
                    ->label('Remarks')
                    ->options([
                        'DONE' => 'DONE',
                        'REFUND' => 'REFUND'
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('scholar_id')
            ->columns([
                Tables\Columns\TextColumn::make('institution.name')
                    ->label('Educational Institution')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Course')
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_of_acceptance')
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_of_ending')
                    ->sortable(),
                Tables\Columns\TextColumn::make('do_number')
                    ->label('D.O Number'),
                Tables\Columns\TextColumn::make('remarks')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'DONE' => 'success',
                        'REFUND' => 'warning'
                    })
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modalHeading('Add Educational Info'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalHeading('Educational Info'),
                    Tables\Actions\DeleteAction::make()->modalHeading('Delete Education Info'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
