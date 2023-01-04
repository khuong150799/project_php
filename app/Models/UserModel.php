<?php

namespace App\Models;

use CodeIgniter\Model;

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
        print_r($id) ;
		$result =  $builder->update($data,$id);
        // print_r($result) ;
        if ($result) {
			return array(
				'message'	=> 'Update value successful!',
				'type' => 'successful'
			);
		}
    }
}