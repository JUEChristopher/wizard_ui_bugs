<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SheetResource\Pages;
use App\Filament\Resources\SheetResource\RelationManagers;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\Sheet;
use App\Models\Speciality;
use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class SheetResource extends Resource
{
    protected static ?string $model = Sheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListSheets::route('/'),
            'create' => Pages\CreateSheet::route('/create'),
            'edit' => Pages\EditSheet::route('/{record}/edit'),
        ];
    }

    public static function getTitleFormField(): TextInput
    {
        return TextInput::make('title')
            ->required();
    }

    public static function getCodeFormField(): TextInput
    {
        return TextInput::make('code')
            ->required();
    }

    public static function getTrainerFormField(): TextInput
    {
        return TextInput::make('trainer')
            ->required();
    }

    public static function getUrlFormField(): TextInput
    {
        return TextInput::make('course_url');
    }

    public static function getTargetAudienceFormFieldset(): Fieldset
    {
        return Fieldset::make('Target')
            ->schema([
                TextInput::make('course'),
                TextInput::make('option'),
                TextInput::make('team'),
                TextInput::make('module'),
            ]);
    }

    public static function getDurationFormFieldset(): Fieldset
    {
        return Fieldset::make('Duration')
            ->schema([
                TextInput::make('hours')
                    ->suffix('h')
                    ->numeric()
                    ->required(),
                TextInput::make('days')
                    ->suffix('j')
                    ->numeric()
                    ->required()
            ]);
    }

    public static function getObjectivesFormSection(): Section
    {
        return Section::make('Objectives')
            ->collapsible()
            ->collapsed()
            ->schema([
                Repeater::make('objectives')
                    ->label('Objectives list')
                    ->required()
                    ->simple(
                        TextInput::make('objective'),
                    )->defaultItems(0)
            ]);
    }

    public static function getPrerequisitesFormSection(): Section
    {
        return Section::make('Prerequisites')
            ->collapsible()
            ->collapsed()
            ->schema([
                Repeater::make('prerequisites')
                    ->label('Prerequisites list')
                    ->required()
                    ->simple(
                        TextInput::make('prerequisite'),
                    )->defaultItems(0)
            ]);
    }

    public static function getConditionsFormSection(): Section
    {
        return Section::make('Conditions')
            ->collapsible()
            ->collapsed()
            ->schema([
                Repeater::make('conditions')
                    ->label('Conditions list')
                    ->required()
                    ->simple(
                        TextInput::make('condition'),
                    )->defaultItems(0)
            ]);
    }

    public static function getScheduleFormRepeater()
    {
        return Repeater::make('schedule')
            ->reorderable(false)
            ->required()
            ->deletable(false)
            ->collapsed()
            ->defaultItems(1)
            ->schema([
                Repeater::make('tasks')
                    ->label('Tasks list')
                    ->required()
                    ->defaultItems(1)
                    ->simple(
                        TextInput::make('task')
                    )
            ]);
    }

    public static function getInternalCompetenciesFormSection(): Section
    {
        return Section::make('Internal competencies')
            ->collapsible()
            ->schema([
                Repeater::make('internal_competencies')
                    ->label('Internal competencies list')
                    ->required()
                    ->simple(
                        TextInput::make('internal_competency'),
                    )->defaultItems(0)
            ]);
    }
}
