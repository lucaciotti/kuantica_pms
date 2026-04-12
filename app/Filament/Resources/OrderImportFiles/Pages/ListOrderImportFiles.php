<?php

namespace App\Filament\Resources\OrderImportFiles\Pages;

use App\Filament\Resources\OrderImportFiles\OrderImportFileResource;
use App\Jobs\ImportOrders;
use App\Models\OrderImportFile;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListOrderImportFiles extends ListRecords
{
    protected static string $resource = OrderImportFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
            Action::make('uploadFile')
                ->schema([
                    FileUpload::make('filename')
                        ->label('Carica tracciato excel')
                        ->openable()
                        // ->directory('task_import_files')
                        ->visibility('public')
                        ->storeFiles(false)
                        ->preserveFilenames()
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ])
                ->action(function (array $data): void {
                    if (array_key_exists('filename', $data)) {
                        try {
                            $date = Carbon::now();
                            $file = $data['filename'];
                            $extension = $file->getClientOriginalExtension();
                            $originalName = $file->getClientOriginalName();
                            $newName = $date->format('Ymd') . '_' . $date->format('Hmi');
                            $path = $file->storeAs('order_import_files', $newName . '.' . $extension);
                            $savedata = [
                                'status' => 'File Caricato',
                                'path' => $path,
                                'filename' => $originalName
                            ];
                            $importFile = OrderImportFile::create($savedata);
                            $recipient = auth()->user();
                            ImportOrders::dispatch($importFile->id)->onQueue('tasks');
                            Notification::make()
                                ->title('Importazione Ordini')
                                ->title('File ' . $originalName . ' caricato')
                                ->sendToDatabase($recipient);
                        } catch (\Throwable $th) {
                            $recipient = auth()->user();
                            Notification::make()
                                ->title('Errore Importazione Ordini')
                                ->body($th->getMessage())
                                ->sendToDatabase($recipient);
                        }
                    } else {
                        Notification::make()
                            ->title('Nessun file caricato!')
                            ->warning()
                            ->send();
                    }
                })
        ];
    }
}
