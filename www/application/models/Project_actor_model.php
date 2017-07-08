<?php
require_once 'my_model.php';

class Project_actor_model extends MyModel {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->name = 'project_actor';
    }
    function get_one($expr){
        return $this->common_get_one($this->name, $expr);
    }
    function get_list($expr){
        return $this->common_get_list($this->name, $expr);
    }
    function save($data){
        return $this->common_save($this->name, $data);
    }
    function update($data, $expr){
        return $this->common_update($this->name, $data, $expr);
    }
    function del($expr){
        return $this->common_delete($this->name, $expr);
    }    

    function is_exists($userid, $projectid){
        // $query = $this->db->get_where('project_actor', array('projectid'=>$projectid));
        $query = $this->db->select('*')->from('project_actor')
            ->where('projectid', $projectid)
            ->where('actorid', $userid)
            ->get();

        $res = $query->result();
        if (!empty($res)){
            return true;
        }
        return false;
    }




}
?>