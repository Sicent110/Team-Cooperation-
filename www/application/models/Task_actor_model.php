<?php
require_once 'my_model.php';

class Task_actor_model extends MyModel {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->name = 'task_actor';
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

    function get_many($expr){
        $query = $this->db->get_where('task', $expr);
        $res = $query->result();
        if (count($res)===0){
            return array(
                'status'=> 1,
                'res'=> "No project",
                );
        }
        $ret = array();
        foreach ($res as $row) {
            $ret[] = $row;
        }

        return array(
            'status'=> 0,
            'res'=> $ret,
            );

    }

    function get($expr, $col='*'){
        $query = $this->db->select($col)->from('task_actor')->where($expr)->get();
        $res = $query->result_array();
        return $res;
    }

    // function save($rec){
    //     // 检查多对多记录是否已存在
    //     if ($this->is_in($rec['actorid'], $rec['taskid'])){
    //         return ;
    //     }
    //     $rec['actorid'] = intval($rec['actorid']);
    //     // $this->db->insert("task_actor", $rec);
    //     return $this->common_save('task_actor', $rec);
    // }

    function is_in($actorid, $taskid){

        $query = $this->db->select('*')->from('task_actor')
            ->where('taskid', $taskid)
            ->where('actorid', $actorid)
            ->get();

        $res = $query->result();
        if (!empty($res)){
            return true;
        }
        return false;
    }
    // function del($expr){
    //     return $this->common_del('task_actor', $expr);
    // }
}
?>