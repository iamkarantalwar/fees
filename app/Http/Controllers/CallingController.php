<?php

namespace App\Http\Controllers;

use App\Calling;
use Illuminate\Http\Request;
use App\Enquiry;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class CallingController extends Controller
{public function __construct()
    {
        $this->middleware('auth');
      
    }
   
    public function index()
    {
    
        return view('admin.calling.new');
    }

    
    public function create(Request $request)
    {
        $id = $request->get('enquiry_id');
        if ($id != null){
            $enquiry = Enquiry::findOrFail($id);
            return view('admin.calling.create',['enquiry'=>$enquiry]);
        }
        else{
            return redirect()->back();
        }
       
    }

    public function store(Request $request)
    {
        $call = new Calling();
        $call->status = $request->post('status');
        $call->narration = $request->post('narration');
        $call->enquiry_id = $request->post('enquiry_id');
        $call->save();
        return redirect()->back()->with('success','Call has been added');
    }

    
    public function show(Calling $calling)
    {
        return redirect()->back();
    }

    public function edit(Calling $calling)
    {
        return redirect()->back();
    }

  
    public function update(Request $request, Calling $calling)
    {
        $calling->narration = $request->post('narration');
        $calling->status = $request->post('status');
        $calling->save();
        return redirect()->back()->with('primary',"Call has been updated");
    }

   
    public function destroy(Calling $calling)
    {
        $calling->delete();
        return redirect()->back()->with('danger',"Call has bee deleted.");
    }

    public function generateExcelSheet()
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
           
            
            $enquiries = Enquiry::all();

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
            $writer = new Xlsx($object);
           
            $writer->save('helloworld.xlsx');
    }
}
