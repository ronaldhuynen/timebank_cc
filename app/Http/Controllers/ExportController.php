<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function __construct(int $year = null)
    {
        $year = 2011;
        $this->year = $year;
    }
   

    public function allUsersExport()
    {
        return Excel::download(new UsersExport($this->year), 'users.xlsx');
    }
}
