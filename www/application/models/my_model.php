<?php

class MyModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        
    }
    function common_get_one($tablename, $expr, $datatype='array'){
        $query = $this->db->get_where($tablename, $expr);
        if ($datatype==='object'){
            return $query->row();
        }
        return $query->row_array();

    }
    function common_get_list($tablename, $expr, $datatype='array'){
        $query = $this->db->get_where($tablename, $expr);
        if ($datatype==='object'){
            $res = $query->result();
        }else{
            $res = $query->result_array();
        }
        return $res;

    }
    function common_save($tablename, $rec){
        $res = $this->db->insert($tablename, $rec);
        if (!$res){
            return false;
        }
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function common_delete($tablename, $expr){
        try{
            $res = $this->db->delete($tablename, $expr);
            return $res;
        }catch(Exception $e){
            return false;
        } 
        
    }
    function common_update($tablename, $data, $expr){
        $res = $this->db->update($tablename, $data, $expr);
        return $res;
    }
    
}
?>