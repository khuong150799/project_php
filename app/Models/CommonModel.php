<?php

namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model
{
    public function SelectQuery($table, $where = '')
    {
        $builder = $this->db->table($table);
        $builder->select("*");
        $builder->join('category', 'student.category=category.category_id', 'left');
        if ($where != '') {
            $builder->like('fullname', trim($where));
            $builder->orLike('email', trim($where));
            $builder->orLike('phone', trim($where));
            $builder->orLike('course', trim($where));
        }
        $result = $builder->get();
        // echo $this->db->getLastQuery();
        return $result->getResultArray();
    }

    public function selectCate($table)
    {
        $builder = $this->db->table($table);
        // $builder->select("*");
        // $builder->select("category_id");
        // $builder->from("category");
        // $builder->groupBy("category_id");  
        $result = $builder->get();
        // $result = $builder->get();
        return $result->getResultArray();
    }

    public function insertValue($table, $data)
    {
        $builder = $this->db->table($table);
        $query = $builder->insert($data);
        return $query;
    }

    public function updateValue($table, $where, $data)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        print_r($where);
        $query = $builder->update($data);
        return $query;
    }

    public function deleteValue($table, $where)
    {
        $builder = $this->db->table($table);

        return $builder->delete($where);
    }

    public function selectQueryRow($table, $where = array())
    {
        $builder = $this->db->table($table);
        $builder->select("*");
        $builder->where($where);
        $result = $builder->get();
        // echo $this->db->getLastQuery();
        return $result->getRow();
    }
}
