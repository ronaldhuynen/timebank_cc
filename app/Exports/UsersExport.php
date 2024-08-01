<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    use Exportable;

    public function __construct(int $year = null)
    {
        $this->year = $year;
    }
    
public function headings(): array
    {
        return [
            'Name',
            'Full name',
            'Email',
            'Created At',
            'Updated At',
            'Language',
        ];
    }


    public function query()
    {
        $query = User::query()
            ->select(
                'name',
                'full_name',
                'email',
                'created_at',
                'updated_at',
                'lang_preference'
            );

        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }

        return $query;
    }

    public function map($user): array       // Note that $user is created in this line
    {
        return [
            $user->name,
            $user->full_name,
            $user->email,
            Carbon::parse($user->created_at)->translatedFormat('Y-m-d H:i:s'),
            Carbon::parse($user->updated_at)->translatedFormat('Y-m-d H:i:s'),
        ];
    }


    public function columnFormats(): array
    {
        // The columnFormats method sets the format of the date columns to NumberFormat::FORMAT_TEXT 
        // to ensure the dates are treated as text, preserving the locale-specific formatting.
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
