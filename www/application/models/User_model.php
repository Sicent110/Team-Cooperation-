<?php
require_once 'my_model.php';

class User_model extends MyModel{

    // private static tablename = "User";

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        // $this->config->load("my_models");
        // $this->tablename = my_models=>users=>__table_name__;
        $this->name = 'users';
        $this->load->model('project_actor_model');
        $this->load->model('task_actor_model');
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
    function get_users_by_projectid($projectid){
        $query = $this->db->query('
SELECT *
FROM '.$this->name.' 
WHERE id IN (SELECT actorid FROM project_actor WHERE projectid = '.strval($projectid).')');
        return $query->result_array();

    }
    function get_users_by_taskid($taskid){
        $query = $this->db->query('
SELECT *
FROM '.$this->name.' 
WHERE id IN (SELECT actorid FROM task_actor WHERE taskid = '.strval($taskid).')');
        return $query->result_array();

    }
    function get_users_by_projectid_notin($projectid, $arr){
        $arr = implode(',', $arr);
        $query = $this->db->query('
SELECT *
FROM '.$this->name.' 
WHERE id IN (SELECT actorid FROM project_actor WHERE projectid = '.strval($projectid).') AND id NOT IN ('.$arr.')');
        return $query->result_array();

    }  


    public function get_user($userid= FALSE)
    {
        if ($userid === FALSE){
            $query = $this->db->get($this->tablename);
            return $query->result_array();
        }

        $query = $this->db->get_where($this->tablename, array('userid' => urldecode($userid)));
        return $query->row_array();
    }

    public function set_user()
    {
        // $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert($this->tablename, $data);
    }

    function is_exists($userid){
        $query = $this->db->get_where("users", array('id'=> $userid));
        $res = $query->row_array();
        if (count($res)!== 0){
            return true;
        }
        return false;
    }
    function get_many($expr){
        // return $this->common_get_many('users', $expr, 'array');
        $query = $this->db->get_where('users', $expr);
        return $query->result_array();
    }


}










