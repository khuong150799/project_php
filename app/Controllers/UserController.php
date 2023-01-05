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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
                // print_r($file);
                $this->UserModels->uploads($thumb);
            };
            // $file->move($this->'uploads/thumb' . date("Y") . '/' . date("m") . '/' , $cvName);
            

            $data_post['created_at'] =time();
            $data_post['updated_at'] =time();
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $fileThumbOld ='uploads/thumb/'. $data->thumb;
        $fileImageOld ='uploads/image/'. $data->thumb;
  
        if($this->request->getPost()){
            $data_post = $this->request->getPost('data-post');
            try {
                if (file_exists($fileThumbOld)) {
                    if ($data->thumb != '') {
                        unlink($fileThumbOld);
                        unlink($fileImageOld);
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
                $this->UserModels->uploads($thumb);
            };
            // $file->move($this->'uploads/thumb' . date("Y") . '/' . date("m") . '/' , $cvName);
            
            $data_post['created_at'] = time();
            $data_post['updated_at'] = time();
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

    function remove($id){
        $data_get_by_id = $this->UserModels->getById($id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $fileImageOld ='uploads/image/'. $data_get_by_id->thumb;
        $fileThumbOld ='uploads/thumb/'. $data_get_by_id->thumb;

        if(file_exists($fileThumbOld)&& ($data_get_by_id->thumb != '')){
            unlink($fileThumbOld);
            unlink($fileImageOld);
        };
        $result = $this->UserModels->remove(array('id' => $id));
        if($result['type'] = 'successful'){
            return redirect()->back()->with("success", 'Thêm thành công');
        };
    }

}
 