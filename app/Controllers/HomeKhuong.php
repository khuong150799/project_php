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
        $limit = '10';
        if($this->request->getGet('search')){
            $query = $this->request->getGet('search'); 
            $orderBy = $this->request->getGet('orderBy'); 
            $offset = $this->request->getGet('offset');
            $limit = $this->request->getGet('limit'); 
          
            print_r(isset($query)?$query:23136521465);
            $result = "";
            $page ='';
        //     if($datas['data']->getNumRows() > 0 ){
        //         foreach ($datas['data']->getResult() as $values) {
        //             $result .='
        //             <tr>
        //                 <th class="table-title">'.$values->fullname.'</th>
        //                 <th class="table-title">'.$values->email.'</th>
        //                 <th class="table-title">'.$values->phone.'</th>
        //                 <th class="table-title">'.$values->address.'</th>
        //                 <th class="table-title"><img class="img"
        //                         src="http://localhost:9999/uploads/thumb/'.$values->thumb.'" alt="gái xinh"></th>
        //                 <th class="table-title"><a href="http://localhost:9999/user/update/'.$values->id.'">edit</a></th>
        //                 <th class="table-title"><a href="http://localhost:9999/user/delete/'.$values->id.'">delete</a>
        //                 </th>
        //                 <th class="table-title"></th>
    
        //             </tr>';
        //         };
        //         $totalPage = ceil($datas['totalRows']/$limit);
        //         for ($i=1; $i <= $totalPage ; $i++) { 
                
        //             $page.='<button>'.$i.'<button>';
        //         };
        // }
            // $resultEnd = $result.$page;
            // echo $resultEnd;
            // $data = [
            //     'data_search' => $datas['data'],
            //     'path_thumb' => 'uploads/image'
            // ];
            // return view('welcome_message', $data);
       
        }
        $datas = $this->UserModels->getAll($query,$orderBy,$offset,$limit);
        $totalPage = ceil($datas['totalRows']/$limit);
        $data = [
            'data_index' => $datas['data'],
            'total_page' => $totalPage,
            'path_thumb' => 'uploads/image'
        ];
        return view('welcome_message', $data);
    }
}
