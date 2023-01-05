<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SearchModel;

class Search extends BaseController
{
    private $title         = 'Tìm kiếm';
    private $template      = 'search/';
    public $control        = 'search';

    public function __construct()
    {
        $this->searchModel = new SearchModel;
    }

    public function index()
    {
        $data =[
            'title' => $this->title,
            'template' => $this->template.'index'
        ];
        return view('default', $data);
    }

    public function add(){
        $data = [
            'title' => $this->title,
            'control' => $this->control,
            'template' => $this->template.'add'
        ];
        
        if($this->request->getPost()){
            // data created
                $this->searchModel->insert($this->request->getPost('data_cr'));
                return redirect()->to(base_url($this->template.'index'))->with('success' , 'Thêm dữ liệu thành công');
        }

        return view('default', !empty($data)? $data : [] );
    }

    public function del(){
        $data = [
            'title' => $this->title,
            'template' => $this->template.'add'
        ];
        
        if($this->request->getVar()){
            $this->searchModel->where('id', $this->request->getVar('id'))->delete();
        }

        return view('default', !empty($data)? $data : [] );
    }

    public function setting($id){
            // data updated
            $bl = $this->searchModel;
            if($this->request->getPost()){
                foreach($this->request->getPost('data_up') as $dataUp => $val){
                    $bl->set($dataUp, $val);
            }
            $bl->where('id', $id);
            $bl->update();
            return redirect()->to(base_url($this->template.'index'))->with('success' , 'Chỉnh sửa thành công');
        }
        $data = [
            'title' => $this->title,
            'template' => $this->template.'setting',
            'control' => $this->control,
            'datas' => $this->searchModel->where('id', $id)->get()->getResult()
        ];

        return view('default', !empty($data)? $data : [] );
    }

    public function myQuery(){
        $query = '';
        $tbl = '';
        if($this->request->getPost('query')){
            $query = $this->request->getPost('query');
        }

        $data = $this->searchModel->myFetch($query);

        if($data->getNumRows() > 0)
		{
			foreach($data->getResult() as $row)
			{
				$tbl .= '
						<tr>
							<td>'.$row->id.'</td>
							<td>'.$row->fullname.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->phone.'</td>
							<td>'.$row->address.'</td>
							<td>
                                <a type="button" class="btn btn-warning" href="/'.$this->control.'/setting/'.$row->id.'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <button type="button" class="btn btn-danger" del="'.$row->id.'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </button>
                            </td>
						</tr>
				';
			}
		}
		else
		{
			$tbl .= '<tr>
						<td colspan="6">No Data Found</td>
                    </tr>';
		}
        //ajax delete button
        // had been minify js
        $tbl .= '<script>function renderData(t=""){$.post("http://localhost:9999/search/ajax/getquery",{query:t},(function(t){$("#data").html(t)}))}$("button").click((function(){$(this).attr("del")&&Swal.fire({title:"Xóa?",text:"Cột này sẽ bị xóa vĩnh viễn",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Đồng ý!"}).then((t=>{t.isConfirmed&&$.post("http://localhost:9999/search/ajax/del",{id:$(this).attr("del")},(function(){Swal.fire("Xóa thành công!","Cột đã bị xóa.","success"),renderData()}))}))}));</script>';

        echo $tbl;


    }
}
