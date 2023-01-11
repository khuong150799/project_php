<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CRUD extends BaseController
{
    private $title         = 'CRUD';
    private $template      = 'crud/';

    public function select()
    {
        $model = new CommonModel();
        $query = '';
        if ($this->request->getGet('q')) {
            $query = $this->request->getGet('q');
        }
            
        $result = $model->SelectQuery('student', $query);
        $data = [
            'title' => $this->title,
            'template' => $this->template . 'select',
            'result' => $result,
        ];
        // } else {
        //     $result = $model->SelectQuery('student');
        //     $data = [
        //         'title' => $this->title,
        //         'template' => $this->template . 'select',
        //         'result' => $result,
        //     ];
        //     // $data = [
        //     //     'title' => 'CRUD',
        //     //     'result' => $result,
        //     // ];
        // }

        return view('default', $data);
        // return view('crud/select', $data);
    }
    public function insert($id = null)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $model = new CommonModel();

        $data['title'] = "Insert Page";
        $data['editRecord'] = '';
        if ($id != null) {
            $fetchRow = $model->selectQueryRow('student', array('id' => $id));
            if (!empty($fetchRow)) {
                $data['editRecord'] = $fetchRow;
            } else {
                return redirect()->to(base_url('crud'));
            }
        }

        $resultCate = $model->selectCate('category');
        $data['dataCate'] = $resultCate;

        if ($this->request->getMethod() == 'post') {
            $rules = $this->validate(
                [
                    'name' => ['label' => 'name', 'rules' =>  'trim|required'],
                    'email' => ['label' => 'email', 'rules' => 'trim|required'],
                    'phone' => ['label' => 'phone', 'rules' => 'trim|required'],
                    'course' => ['label' => 'course', 'rules' => 'trim|required'],
                    'category' => ['label' => 'category', 'rules' => 'trim|required'],
                ]
            );
            if ($rules == true) {
                $name = $this->request->getPost('name');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $course = $this->request->getPost('course');
                $category = $this->request->getPost('category');
                $date = time();
                //insert Data
                $insert = [
                    'fullname' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'course' => $course,
                    'category' => $category,
                    $id ? 'updated_date' : 'creation_date' => $date,
                ];
                if ($id == null) {
                    $model->insertValue('student', $insert);
                } else {
                    $model->updateValue('student', array('id' => $id), $insert);
                }
                return redirect()->to(base_url('crud'))->with('status', 'Cập nhật dữ liệu thành công!');
            } else {
                return view('crud/insert', $data);
            }
        } else {

            return view('crud/insert', $data);
        }
    }
    public function deleteUser($id)
    {
        $model = new CommonModel();
        if ($id != null) {
            $fetchRow = $model->selectQueryRow('student', array('id' => $id));
            if (!empty($fetchRow)) {
                $where = array('id' => $id);
                $model->deleteValue('student', $where);
                return redirect()->to(base_url('crud'))->with('status', 'Xóa dữ liệu thành công!');
            } else {
                return redirect()->to(base_url('crud'));
            }
        }
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
