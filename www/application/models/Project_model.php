<?php
require_once 'my_model.php';

class Project_model extends MyModel {

    // private static tablename = "User";

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->name = 'project';
        $this->load->model('project_actor_model');
        $this->load->model('task_model');
    }

    function get_one($expr){
        return $this->common_get_one($this->name, $expr);
    }
    function get_list($expr){
        return $this->common_get_list($this->name, $expr);
    }
    function save($data, $userid){
        $this->db->trans_start();

        $insert_id = $this->common_save($this->name, $data);

        $project_actor_rec = array(
            'projectid'=> $insert_id,
            'actorid'=>$userid,
            );
        $this->project_actor_model->save($project_actor_rec);

        $this->db->trans_complete();
        return $insert_id;
    }
    function update($data, $expr){
        return $this->common_update($this->name, $data, $expr);
    }
    function del($expr, $projectid){
        $this->load->model('project_trend_model');
        $this->load->model('share_model');
        $this->db->trans_start();

        $this->task_model->del(array('projectid'=>$projectid));
        $this->project_actor_model->del(array('projectid'=>$projectid));
        $this->common_delete($this->name, $expr);
        $this->project_trend_model->del(array('projectid'=>$projectid));
        $this->share_model->del(array('projectid'=>$projectid));

        $this->db->trans_complete();
    }

    function get_projects_by_userid($userid){
        $query = $this->db->query('
SELECT *
FROM  project
WHERE id IN (SELECT projectid FROM project_actor WHERE actorid = '.strval($userid).')');
        return $query->result_array();

    }
    function add_actor($userid,$projectid){
        $project_actor_rec = array(
            'projectid'=>$projectid,
            'actorid'=>$userid,
            );
        $this->project_actor_model->save($project_actor_rec);
    }


    // get by ownerid
    function get_by_userid($userid, $except=False){
        // var_dump(is_int($userid));
        if (!is_int($userid)){
            asdf();
        }
        if ($except===False){
            $query = $this->db->get_where('project', array('ownerid'=>$userid) );
        }else{
            // $col, $arr = $except;
            $query = $this->db->get_where('project', array('ownerid'=>$userid) );
        }
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
    function get_project($expr, $except=False){
        $query = $this->db->get_where('project', $expr, 1, 0);
        $res = $query->result();
        if (count($res)===0){
            return array(
                'status'=> 1,
                'res'=> "No project",
                );
        }
        $ret = $res[0];

        return array(
            'status'=> 0,
            'res'=> $ret,
            );
    }

    function count($projectid){
        $ret = array();
        for($i=0;$i<3;$i++){
            $query = $this->db->query('select count(*) from `task` where projectid='.$projectid.' and stepstatus='.strval($i));
            $task_pending_num = $query->row_array()['count(*)'];
            $query = $this->db->query('select count(*) from `task` where projectid='.$projectid.' and taskstatus=1 and stepstatus='.strval($i));
            $task_pending_num_done = $query->row_array()['count(*)'];

            $ret[$i] = array($task_pending_num_done, $task_pending_num)  ;
        }

        // $query = $this->db->query('select count(*) from `task` where projectid='.$projectid.' and taskstatus=0 and stepstatus=0');
        // $task_pending_num_doing = $query->row_array()['count(*)'];

        // $query = $this->db->query('select count(*) from `task` where projectid='.$projectid);
        // $all = $query->row_array()['count(*)'];

        // var_dump($ret);
        return $ret;
    }

}
?>