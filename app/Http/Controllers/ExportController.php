<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function allUsersExport($year = null)
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function transactionsExport($type)
    {
        $dataArray = Session::get('export_data', []);
        Session::forget('export_data'); // Optionally clear the session data after use
        $data = collect($dataArray); // Convert array to collection       

        // Process the data and generate the export
        return Excel::download(new TransactionsExport($data), "export.{$type}");
    }
}
