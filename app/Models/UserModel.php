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
    function getAll($query=null,$orderBy=null,$offset='0',$limit='10'){
      $builder = $this->db->table($this->table);
      print_r($query);
      print_r($orderBy);
      print_r($offset);
      print_r($limit);
      if($query){
        $where = 'fullname LIKE "%'.$query.'%" OR email LIKE "%'.$query.'%" OR phone LIKE "%'.$query.'%" OR address LIKE "%'.$query.'%" ORDER BY id '.$orderBy.' LIMIT '.$offset.','.$limit.'';
        $builder->where($where);
        $count = $builder->countAllResults(false);
        $data = $builder->get()->getResult();
        // $data = $builder->get();
        // print_r($count);
         echo $this->db->getLastQuery();
        return array(
          'data' => $data,
          'totalRows' => $count,
        );
        // return $data;

      }else{
        $data = $builder->get()->getResult();
        $count = $builder->countAll();
        // print_r($count);
        // echo $this->db->getLastQuery();
        return array(
          'data' => $data,
          'totalRows' => $count,
        );
      }

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