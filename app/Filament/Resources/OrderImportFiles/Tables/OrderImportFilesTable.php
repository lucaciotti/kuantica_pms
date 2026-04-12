<?php

namespace App\Filament\Resources\OrderImportFiles\Tables;

use App\Jobs\ImportOrders;
use App\Models\OrderImportFile;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderImportFilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('filename')
                ->sortable()
                    ->searchable(),
                TextColumn::make('status')->label('Stato')
                ->sortable()
                    ->searchable(),
                TextColumn::make('date_upload')->label('Data upload')->sortable()
                    ->date()
                    ->sortable(),
                TextColumn::make('date_last_import')->label('Data processato')->sortable()
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
            // EditAction::make(),
                Action::make('Elabora')
                    ->icon(Heroicon::ArrowPath)
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Elabora nuovamente import')
                    ->modalDescription('Si desidera ri-processare l\'importazione?')
                    ->modalSubmitActionLabel('Si, procedi')
                    ->action(fn(OrderImportFile $record) => ImportOrders::dispatch($record->id)->onQueue('tasks')/* ProcessTempTasks::dispatch($record->id, $record->hasWarnings)->onQueue('tasks') */)
                    ->visible(fn(OrderImportFile $record) => in_array($record->status, ['Errore', 'Processato', 'Verificare', 'File Caricato'])),
                Action::make('download')
                    ->label('Download')
                    ->color('success')
                    ->icon(Heroicon::ArrowDownTray)
                    ->action(function (OrderImportFile $record) {
                        return response()->download(storage_path('app/private/' . $record->path), $record->filename);
                        // return response()->streamDownload(function () use ($record) {
                        //     echo Pdf::loadHtml(
                        //         Blade::render('pdf', ['record' => $record])
                        //     )->stream();
                        // }, $record->number . '.pdf');
                    }),
        ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('date_upload', direction: 'desc')
            ->poll('5s');;
    }
}
