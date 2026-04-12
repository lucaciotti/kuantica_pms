<?php

namespace App\Jobs;

use App\Imports\OrdersImport;
use App\Models\OrderImportFile;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private OrderImportFile $importedfile;
    private $hasWarnings;

    /**
     * Create a new job instance.
     */
    public function __construct($import_file_id)
    {
        Log::info('ImportOrders Job Created');
        $this->importedfile = OrderImportFile::find($import_file_id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ImportOrders Job Started');
        $this->importedfile->status = 'Processing';
        $this->importedfile->save();
        Excel::import(new OrdersImport($this->importedfile->id), storage_path('app/private/' . $this->importedfile->path));
        $this->importedfile->status = 'Processato';
        // ProcessTempTasks::dispatch($this->importedfile->id, $this->hasWarnings)->onQueue('tasks');
    }

    public function failed(\Throwable $e)
    {
        $this->importedfile->status = 'Errore';
        $this->importedfile->save();
        report($e);

        $recipient = $this->importedfile->audits()->get()->first()->user;
        Notification::make()
            ->title('Errore Importazione Ordini')
            ->body($e->getMessage())
            ->sendToDatabase($recipient);
    }
}
