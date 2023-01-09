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

        $query = '';
        $orderBy = 'DESC';
        $offset = '0';
        $limit = '1';
        if($this->request->getGet('search')){
            $query = $this->request->getGet('search'); 
        }
        if($this->request->getGet('orderBy')){
            $orderBy = $this->request->getGet('orderBy');
        }
        if($this->request->getGet('limit')){
            $limit = $this->request->getGet('limit');
        }
        if($this->request->getGet('page')){
            $page = $this->request->getGet('page');
            $offset = ($page -1) * $limit;
        }
        $datas = $this->UserModels->getAll($query,$orderBy,$offset,$limit);
        $totalPage = ceil($datas['totalRows']/$limit);
        $data = [
            'data_index' => $datas['data'],
            'total_page' => $totalPage,
            'value_search' => $query,
            'path_thumb' => 'uploads/image'
        ];
        return view('welcome_message', $data);
    }
}
