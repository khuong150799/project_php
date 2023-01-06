<?php

namespace App\Controllers;

use App\Models\UserModel;

class HomeKhuong extends BaseController
{
    function __construct()
    {
        $this->UserModels = new UserModel();
    }
    public function index()
    {
        $datas = $this->UserModels->getAll();
        $data = [
            'data_index' => $datas,
            'path_thumb' => 'uploads/image'
        ];
        return view('welcome_message', $data);
    }
}
