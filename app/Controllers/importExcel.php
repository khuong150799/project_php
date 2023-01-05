<?php

namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

use App\Models\CommonKienModel;
class importExcel extends BaseController
{
    public function index()
    {

        $model = new CommonKienModel();
        $result = $model->selectQuery();
        $data['tableData'] = $result;
        return view('import' , $data);
    }
    public function download() {
        $model = new CommonKienModel();
        $spreadsheet = new Spreadsheet();
        $result = $model->selectQuery();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue("A1" , "Name");
        $sheet->setCellValue("B1" , "phone");
        $sheet->setCellValue("C1" , "email");
        $sheet->setCellValue("D1" , "address");
        $sheet->setCellValue("E1" , "postalZip");
        $sheet->setCellValue("F1" , "region");
        $sheet->setCellValue("G1" , "country");
        // $sheet->setCellValue("H1", "id");
        $count =2;

        foreach($result as $row) {
            $sheet->setCellValue("A" . $count, $row->name);
            $sheet->setCellValue("B" . $count, $row->phone);
            $sheet->setCellValue("C" . $count, $row->email);
            $sheet->setCellValue("D" . $count, $row->address);
            $sheet->setCellValue("E" . $count, $row->postalZip);
            $sheet->setCellValue("F" . $count, $row->region);
            $sheet->setCellValue("G" . $count, $row->country);
            // $sheet->setCellValue("H" . $count, $row->id);
            $count++;

        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('test.xlsx');
        return $this->response->download("test.xlsx" , null)-> setFileName("Customer.xlsx");

    }
    public function upload() {
        $model = new CommonKienModel();
        if($this->request->getMethod() == "post") {
            $rules = $this->validate([
                'filename' => 'uploaded[filename]|max_size[filename,500]|ext_in[filename,csv,xlsx]',
            ]);
            if($rules == true) {
            $filename = $this->request->getFile('filename');
            $name = $filename->getName();
            $tempName = $filename -> getTempName();
            $arr_file = explode("." , $name);
            $extension = end($arr_file);
            print_r($extension);
            if('csv' == $extension) {
                $reader = new Csv();
            }else {
                $reader = new excel();
            }
            $spreadsheet =$reader -> load($tempName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            if(!empty($sheetData)){
                for($i=1 ; $i<count($sheetData); $i++) {
                    $name = $sheetData[$i][0];
                    $phone = $sheetData[$i][1];
                    $email = $sheetData[$i][2];
                    $address = $sheetData[$i][3];
                    $postalZip = $sheetData[$i][4];
                    $region = $sheetData[$i][5];
                    $country = $sheetData[$i][6];
                    // $id = $sheetData[$i][7];
                    $data = [
                        'name' =>$name, 
                        'phone' =>$phone,
                        'email' =>$email,
                        'address' =>$address,
                        'postalZip' =>$postalZip,
                        'region' =>$region,
                        'country' =>$country,
                    ];
                    $model -> insertValue($data);
                }
                return redirect()->to(base_url('/import'));
            }else {
                return view("upload");
            }
        }else {
            return view("upload");
        }
        
        }else {
            return view("upload");

        }
    }
    public function delete($id = null) {
        $model = new CommonKienModel();
        $model->delete($id);
        return redirect()->back()->with('status' , 'deleted Successfully');
    }
  

}
