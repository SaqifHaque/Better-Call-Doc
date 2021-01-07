<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
  
class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $app = DB::table('prescriptions')
                    ->where("appoinment_id",$id)
                    ->first();
        $data = [
          'title' => 'Better Call Doc',
          'heading' => "Doctor",
          'content' => "Disease: ".$app->disease."    

          ". $app->details,       
            ];
        
        $pdf = PDF::loadView('pdf.generate_pdf', $data);
  
        return $pdf->download('codingdriver.pdf');
    }
}