<?php

namespace App\Http\Controllers;
use App\Registration;
use Illuminate\Http\Request;
use PDF;
class PDFInvoiceGenerate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function index($id)
    {
        $registration  = Registration::findOrFail($id);
       
        $paid_fees = 0;
        foreach ($registration->fees as $row) 
        {
            $paid_fees += ($row->payable_amount);
        }       
        $pending_fees = $registration->total_fees - $paid_fees;
        $view = \View::make('admin.invoicepdf.invoice')->with(['registration'=>$registration,'pending_fees'=>$pending_fees]);
        $html = $view->render();
      
        // $html = "<h1>Hello world";
        $pdf = new PDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');
    }
}
