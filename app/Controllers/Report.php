<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\CommonModel;

class Report extends BaseController
{
    public function index()
    {
        $model = new CommonModel();
        $result = $model->SelectQuery('student');
        $data = [
            'title' => 'Report',
            'tableData' => $result,
        ];
        return view('download/index', $data);
    }

    public function export()
    {
        $model = new CommonModel();
        $spreadsheet = new Spreadsheet();
        $result = $model->SelectQuery('student');


        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "STT");
        $sheet->setCellValue('B1', "Full name");
        $sheet->setCellValue('C1', "Email");
        $sheet->setCellValue('D1', "Phone");
        $sheet->setCellValue('E1', "Course");
        $sheet->setCellValue('F1', "Xếp loại");

        $count = 2;
        foreach ($result as $row) {
            $sheet->setCellValue('A' . $count, $count - 1);
            $sheet->setCellValue('B' . $count, $row['fullname']);
            $sheet->setCellValue('C' . $count, $row['email']);
            $sheet->setCellValue('D' . $count, $row['phone']);
            $sheet->setCellValue('E' . $count, $row['course']);
            $sheet->setCellValue('F' . $count, $row['category_title']);
            $count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('data.xlsx');
        return $this->response->download('data.xlsx', null)->setFileName("Student.xlsx");
    }
}
