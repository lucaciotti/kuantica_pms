<?php

namespace App\Imports;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrdersImport implements ToCollection, WithStartRow, SkipsEmptyRows, WithCalculatedFormulas, WithMultipleSheets, SkipsOnError
{
    protected $importedfile;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $num_row = 1;
        $new_state = [];
        foreach ($rows as $row) {
            $num_row++;
            $order_data = [];
            $order_wheredata = [];
            $customer_data = [];
            $customer_find = [];
            $prod_data = [];
            $prod_find = [];
            $department_data = [];
            $department_find = [];

            $department_data['name'] = (string)$row[0];

            $prod_data['code'] = (string)$row[1];

            $customer_data['description'] = (string)$row[2];
            $customer_find['description'] = (string)$row[2];
            $customer_data['code'] = (string)$row[2];

            $order_data['type_production'] = (string)$row[3];
            $order_data['qty'] = (float)$row[4];
            $order_data['qty_res'] = $order_data['qty'];
            $order_data['batch_code'] = (float)$row[5];
            $order_data['date'] = is_numeric($row[6]) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])) : null;
            $order_data['note'] = (string)$row[7];
            $order_data['state'] = OrderStatus::QUEUE;

            if(count($customer_find)>0){
                try {
                    $customer = Customer::firstOrCreate($customer_find, $customer_data);
                } catch (\Throwable $th) {
                    report($th);
                    throw $th;
                }
                if ($customer) {
                    $order_data['customer_id'] = $customer->id;
                } else {
                    continue;
                }
            }

            $department = Department::firstOrCreate($department_data, $department_data);
            if ($department) {
                $order_data['department_id'] = $department->id;
            } else {
                continue;
            }

            $prod = Product::firstOrCreate($prod_data, $prod_data);
            if ($prod) {
                $order_data['product_id'] = $prod->id;
            } else {
                continue;
            }

            $order_wheredata = [
                ['product_id', $order_data['product_id']],
                ['date', $order_data['date']],
                ['type_production', $order_data['type_production']],
                ['batch_code', $order_data['batch_code']],
            ];

            Order::updateOrCreate($order_wheredata, $order_data);
        }
        
    }

    public function onError(\Throwable $th)
    {
        report($th);
        $recipient = $this->importedfile->audits()->get()->first()->user;
        Notification::make()
            ->title('Errore Importazione Ordini')
            ->body($th->getMessage())
            ->sendToDatabase($recipient);
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }
}
