<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

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
            __('Debit/Credit'),
            __('Account nr.'),
            __('Account name'),
            __('Acc. holder'),
            __('Acc. holder full name'),
            __('Counter acc. nr.'),
            __('Counter acc. name'),
            __('Relation name'),
            __('Relation full name'),
            __('Type'),
            __('Description'),
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction['trans_id'],
            $transaction['datetime'],
            tbFormat($transaction['amount']),
            $transaction['amount'],
            __($transaction['c/d']),
            $transaction['account_id'],
            __(ucfirst(strtolower($transaction['account_name']))),
            $transaction['account_holder_name'],
            $transaction['account_holder_full_name'],
            $transaction['account_counter_id'],
            __(ucfirst(strtolower($transaction['account_counter_name']))),
            $transaction['relation'],
            $transaction['relation_full_name'],
            __(ucfirst(strtolower($transaction['type']))),
            $transaction['description'],
        ];
    }

    public function title(): string
    {
        return __('Transactions');
    }
}
