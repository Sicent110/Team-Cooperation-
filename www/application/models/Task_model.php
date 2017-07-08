<?php
require_once 'my_model.php';

class Task_model extends MyModel {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->name = 'task';
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
        $this->db->trans_start();

        foreach($this->get_list($expr) as $_task){
            $taskid = $_task['id'];
            $this->task_actor_model->del(array('taskid'=>$taskid));
        }
        $this->common_delete($this->name, $expr);

        $this->db->trans_complete();
    }    
    
    // function get_many($expr, $datatype='object'){
    //     $query = $this->db->get_where('task', $expr);
    //     if ($datatype==='object'){
    //         $res = $query->result();
    //     }else{
    //         $res = $query->result_array();
    //     }
    //     if (count($res)===0){
    //         return array(
    //             'status'=> 1,
    //             'res'=> "No task be found",
    //             );
    //     }
    //     $ret = array();
    //     foreach ($res as $row) {
    //         $ret[] = $row;
    //     }

    //     return array(
    //         'status'=> 0,
    //         'res'=> $ret,
    //         );

    // }

    // function save($rec){
    //     return $this->common_save('task', $rec);
    // }
    // function del($expr){
    //     return $this->common_del('task', $expr);
    // }
    // function update($data, $expr){
    //     return $this->common_update('task', $data, $expr);
    // }



}
?>