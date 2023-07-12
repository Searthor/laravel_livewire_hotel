<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function generatePDF()
    {
        $employees = DB::table('staff')
        ->join('staff_types', 'staff_type_id', '=', 'staff_types.id')
        ->select('staff.*', 'staff_types.staff_type')
        ->get();
  
        $data = [
            'date' => date('m/d/Y'),
            'employees' => $employees
        ]; 
       
        $pdf = PDF::loadView('employees.pdf', $data);
     
        return $pdf->download('employees.pdf');
    }
}
