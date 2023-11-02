<?php

namespace App\Filament\Resources\SheetResource\Pages;

use App\Filament\Resources\SheetResource;
use Filament\Actions;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateSheet extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = SheetResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Step 1')
                ->schema([
                    SheetResource::getTitleFormField(),
                    SheetResource::getCodeFormField(),
                    SheetResource::getTrainerFormField(),
                    SheetResource::getUrlFormField(),
                    SheetResource::getTargetAudienceFormFieldset(),
                    SheetResource::getDurationFormFieldset(),
                    SheetResource::getObjectivesFormSection(),
                    SheetResource::getPrerequisitesFormSection(),
                    SheetResource::getConditionsFormSection(),
                ])->columns(2),
            Step::make('Step 2')
                ->schema([
                    SheetResource::getScheduleFormRepeater(),
                ]),
            Step::make('Step 3')
                ->schema([
                    SheetResource::getInternalCompetenciesFormSection(),
                ]),
        ];
    }
}
