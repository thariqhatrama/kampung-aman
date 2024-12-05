<?php

namespace App\Filament\Resources\EmergencyResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\EmergencyResource;

class ManageEmergencies extends ManageRecords
{
    protected static string $resource = EmergencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function ($record) {
                    $recipient = $record->user;
 
                    Notification::make()
                        ->title('Saved successfully')
                        ->sendToDatabase($recipient);
                }),
        ];
    }
}
