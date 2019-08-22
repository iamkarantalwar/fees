<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Enquiry;

class ExcelController extends Controller
{

    public function enquiryListWithCalls(Request $request)
    {
        
            
            $object = new Spreadsheet();
            $object->setActiveSheetIndex(0);

            $table_columns = array("Id",  "Name", "College","Semester", "Mobile","Narration","1st Call Time","1st Call Narration",
                                        "2nd Call Time","2nd Call Narration","3rd Call Time","3rd Call Narration"
                                        ,"4th Call Time","4th Call Narration"
                                        ,"5th Call Time","5th Call Narration");
            

            $column = 0;
            foreach($table_columns as $field)
            {
                $style = ['font'=>['size'=>12,'bold'=>true,'color'=>['rgb'=>'ff0000']]];
                $object->getActiveSheet()->getStyle('A1:O1')->applyFromArray($style);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
           
            
            $enquiries = Enquiry::orWhere('college',$request->college)->orWhere('semester',$request->semester);
            $excel_row = 2;

            foreach($enquiries as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->college);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->semester);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->phone_no);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->narration);
                $j = 6;
                foreach ($row->callings as $call) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($j, $excel_row, $call->created_at);
                    $object->getActiveSheet()->setCellValueByColumnAndRow($j+1, $excel_row, $call->narration);
                    $j+=2;
                }

             
                $excel_row++;
            }
            $nCols = 16; //set the number of columns

            foreach (range(0, $nCols) as $col) {
                $object->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);                
            }
            ob_clean();
          
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($object, "Xlsx");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="file.xlsx"');
            $writer->save("php://output");
        
    }



}


?>