<?php
 namespace App\Controllers;
 use App\Controllers\BaseController;
 use App\Models\UserModel;
 class UserController extends BaseController 
 {
    function __construct(){
        $this->UserModels = new UserModel();
    }
    function formAdd(){
        $method=[
            'create' => 'create'
        ];
        return view('add',isset($method)?$method:null);
    }

    function add(){
        $data_index =  $this->UserModels->getAll();
        // dd($data_index);
        if($this->request->getPost()){
            $data_post = $this->request->getPost('data-post');
            
            if(isset($_FILES['image'])){
                $type = pathinfo($_FILES['image']["type"], PATHINFO_FILENAME);
                $data_index['type'] = $type;

                $filename = pathinfo($_FILES['image']["name"], PATHINFO_FILENAME);               
                $data_post['image'] = $filename.'.'.$type;


                $thumb =str_replace(' ', '-', $filename.'_'.date('dmYHis').'.'.$type);
                $data_post['thumb'] = $thumb;
                $file = $this->request->getFile('image');
                $file->move('uploads/image/',$thumb);
            };
            // $file->move($this->'uploads/thumb' . date("Y") . '/' . date("m") . '/' , $cvName);
            

            $data_post['created_at'] = date('Y/m/d H:i:s');
            $data_post['updated_at'] = date('Y/m/d H:i:s');
            $result = $this->UserModels->add($data_post);
            if($result['type'] == 'successful'){
                return redirect()->to('http://localhost:9999')->with("success", 'Thêm thành công');
            };
        }

        $datas = [

            'data_index' =>$data_index,
            'path_thumb' => 'uploads/image',
        ];
        
        return view('welcome_message',isset($datas)?$datas:null);
    }

    function edit($id){
        $data = $this->UserModels->getById($id);

        $fileThumbOld ='uploads/image/'. $data->thumb;
  
        if($this->request->getPost()){
            $data_post = $this->request->getPost('data-post');
            try {
                if (file_exists($fileThumbOld)) {
                    if ($data->thumb != '') {
                        unlink($fileThumbOld);
                    }
                }
            } catch (\Throwable $th) {
                throw $th;
            }
            if(isset($_FILES['image'])){
                $type = pathinfo($_FILES['image']["type"], PATHINFO_FILENAME);
                // $data['type'] = $type;

                $filename = pathinfo($_FILES['image']["name"], PATHINFO_FILENAME);               
                $data_post['image'] = $filename.'.'.$type;


                $thumb =str_replace(' ', '-', $filename.'_'.date('dmYHis').'.'.$type);
                $data_post['thumb'] = $thumb;
                $file = $this->request->getFile('image');
                $file->move('uploads/image/',$thumb);
            };
            // $file->move($this->'uploads/thumb' . date("Y") . '/' . date("m") . '/' , $cvName);
            

            $data_post['created_at'] = date('Y/m/d H:i:s');
            $data_post['updated_at'] = date('Y/m/d H:i:s');
            // echo $data_post;
            $result = $this->UserModels->edit(array('id' => $id),$data_post);
            if($result['type'] == 'successful'){
                return redirect()->to('http://localhost:9999')->with("success", 'Thêm thành công');
            };
        }
        $datas = [
    
            'data' => $data,
            'path_thumb' => 'uploads/image',
        ];
            return view('add',isset($datas)?$datas:null);
    }

}
 