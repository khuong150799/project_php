<?php

namespace App\Models;

use CodeIgniter\Model;

use app\Config\Images;


class UserModel extends Model
{
    protected $table = 'users';
    function __construct(){
      $this->db  = \Config\Database::connect('default');
    }
    function getAll(){
      $builder = $this->db->table($this->table);
      $data = $builder->get()->getResult();
      return $data;

    }
    function getById($id){
      $builder = $this->db->table($this->table)->where('id',$id);
      $data = $builder->get()->getRow();
      return $data;

    }
    function add($data){     
      $builder = $this->db->table($this->table);
      $result =  $builder->insert($data);
      $insertID = $this->db->insertID();

          if ($result) {
        return array(
          'insertID' => $insertID,
          'type' => 'successful'
        );
      }
    }
    function edit($id,$data){     
      $builder = $this->db->table($this->table);
          // print_r($data) ;
      $result =  $builder->update($data,$id);
    
          if ($result) {
        return array(
          'message'	=> 'Update value successful!',
          'type' => 'successful'
        );
      }
    }
    function remove($id){
      $builder = $this->db->table($this->table);
      $result = $builder->delete($id);
      if($result){
        return array(
          'type' => 'successful'
        );
      }
    }
    function uploads($thumb){
      print_r('uploads/image/'.$thumb);
      \Config\Services::image()
    ->withFile('uploads/image/'.$thumb)
    ->resize(200, 100, true, 'height')
    ->save('uploads/thumb/'.$thumb);
    }
}