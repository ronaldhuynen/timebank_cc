<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionsExport implements FromCollection, WithTitle, WithHeadings, WithMapping
{
    use Exportable;

    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            __('Nr.'),
            __('Date'),
            __('Amount'),
            __('Amount in minutes'),
            __('Type'),
            __('Account nr.'),
            __('Account name'),
            __('Holder'),
            __('Holder full name'),
            __('Counter acc. nr.'),
            __('Counter acc. name'),
            __('Relation name'),
            __('Relation fulle name'),
            __('Description'),
            __('Balance'),
            __('Balance in minutes')
        ];
    }

    public function map($transaction): array
    {
        // dd($transaction);

        return [
            $transaction['trans_id'],
            $transaction['datetime'],
            tbFormat($transaction['amount']),
            $transaction['amount'],
            $transaction['type'],
            $transaction['account_id'],
            $transaction['account_name'],
            $transaction['account_holder_name'],
            $transaction['account_holder_full_name'],
            $transaction['account_counter_id'],
            $transaction['account_counter_name'],
            $transaction['relation'],
            $transaction['relation_full_name'],
            $transaction['description'],
            tbFormat($transaction['balance']),
            $transaction['balance'],
        ];

    }

    public function title(): string
    {
        return 'Transactions';
    }
}
