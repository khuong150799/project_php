<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use DateTime;

class CRUD extends BaseController
{
    public function select()
    {
        $model = new CommonModel();
        if ($this->request->getGet('q')) {
            $query = $this->request->getGet('q');
            $result = $model->SelectQuery('student', $query);

            // $result = $model->SelectQuery('student', array('fullname' => $query));
            // if (empty($result)) {
            //     $result = $model->SelectQuery('student', array('email' => $query));
            // }
            $data = [
                'title' => 'CRUD',
                'result' => $result,
            ];
        } else {
            $result = $model->SelectQuery('student');
            $data = [
                'title' => 'CRUD',
                'result' => $result,
            ];
        }


        return view('crud/select', $data);
    }
    public function insert($id = null)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // print_r($_POST['agent_name']);
        // echo "<br>";
        // print_r($this->request->getPost('agent_name'));
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


        if ($this->request->getMethod() == 'post') {
            $rules = $this->validate(
                [
                    'name' => ['label' => 'name', 'rules' =>  'trim|required'],
                    'email' => ['label' => 'email', 'rules' => 'trim|required'],
                    'phone' => ['label' => 'phone', 'rules' => 'trim|required'],
                    'course' => ['label' => 'course', 'rules' => 'trim|required'],
                ]
            );
            if ($rules == true) {
                $name = $this->request->getPost('name');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $course = $this->request->getPost('course');
                // $date = date('y-m-d H:i:s');

                $date = time();
                //insert Data
                $insert = [
                    'fullname' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'course' => $course,
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
    public function getCategory()
    {
        $model = new CommonModel();
    }
}
