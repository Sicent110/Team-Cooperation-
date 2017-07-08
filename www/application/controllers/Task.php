<?php
require_once 'my_controller.php';

class Task extends MyController{

    public function __construct(){
        parent::__construct();
    }

    function lists(){
        $method = 'get';
        $this->load->model('task_model');
        $this->load->model('project_actor_model');

        $userid = $this->userdata['userid'];
        $projectid = $this->input->$method('projectid');

        $this->verify_by_rule(array(
            'userid'=> $userid,
            'projectid'=> $projectid,
            ),
            'project_add_member');

        if (!$this->is_project_member($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $tasks = $this->task_model->get_list(array('projectid'=>$projectid));
        $this->response_json($tasks);
    }    

    function add(){
        $method = 'post';
        $this->load->model('task_model');
        $this->load->model('user_model');
        $this->load->model('project_actor_model');
        $this->load->model('task_actor_model');

        $task_content = $this->input->$method('task_content');
        $projectid = $this->input->$method('projectid');
        $actorids= $this->input->$method('actorids');
        $stepstatus= $this->input->$method('stepstatus');
        $userid = $this->userdata['userid'];

        $this->verify_by_rule(array(
            'userid'=> $userid,
            'projectid'=> $projectid,
            'task_content'=> $task_content,
            'stepstatus'=>$stepstatus,
            ),
            'task_add');

        if (!$this->is_project_creator($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        // $valid_ids = array_filter($actorids, function($actorid){
        //     return $this->user_model->is_exists($actorid);
        // });

        $task_rec=array(
            'taskname'=>$task_content,
            'createdate'=>get_now(),
            'projectid'=>$projectid,
            'stepstatus'=>$stepstatus,
            'ownerid'=>$userid,
            );

        $taskid = $this->task_model->save($task_rec);

        if ($actorids){
            foreach ($actorids as $actorid) {
                $this->_add_actor($taskid, $actorid);
            }
        }

        // 写入trend
        $this->load->model('project_trend_model');
        $now = date('y-m-d h:i:s',time());
        $project_trend_rec = array(
            'eventinfo'=> '用户 '.$this->userdata['username'].' 添加任务 '.$task_content,
            'createdate'=> $now,
            'projectid'=>$projectid,
            );
        $this->project_trend_model->save($project_trend_rec);
       
        // redirect('project/lists');
        
        // $task_actor_ret = true;
        // // 插入task_actor
        // foreach ($valid_ids as $actorid) {
        //     $task_actor_rec = array(
        //         'taskid'=>$taskid,
        //         'actorid'=>$actorid,
        //         );
        //     $_ret = $this->task_actor_model->save($task_actor_rec);
        //     if (is_null($_ret)||$_ret['status']!==0){
        //         $task_actor_ret = false;
        //     }
        // }

        $this->response_json(array('taskid'=>$taskid));

    }

    function edit_page(){
        $method = 'get';
        $userid = $this->userdata['userid'];

        $this->load->model('task_model');
        $this->load->model('task_actor_model');
        $this->load->model('user_model');
        $this->load->model('project_actor_model');

        $projectid = $this->input->$method('projectid');
        $taskid = $this->input->$method('taskid');

        $this->verify_by_rule(array(
            'taskid'=> $taskid,
            'projectid'=> $projectid,
            ),
            'task_edit_page');

        if (!$this->is_project_member($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $task_array = $this->task_model->get_one(array('id'=>$taskid));

        $data['task_rec'] = $task_array;
        $data['projectid'] = $projectid;
        $data['task_type'] = $this->my_map['task_type'];

        $_actorids = $this->task_actor_model->get_list(array('taskid'=>$taskid));
        $task_actors = array();
        $actorids = array();
        foreach ($_actorids as $actorid) {
            $actorid = $actorid['actorid'];
            $actorids[] = $actorid;
            $_userinfo = $this->user_model->get_one(array('id'=>$actorid));
            $task_actors[] = $_userinfo;
        }
        $data['task_actors'] = $task_actors;

        // $member_ids = $this->project_actor_model->get(array('projectid'=>$projectid), 'actorid');
        // $member_infos = array();
        // foreach($member_ids as $memberid){
        //     $memberid = $memberid['actorid'];
        //     if (in_array($memberid, $actorids)){
        //         continue;
        //     }else{
        //         $memberinfo = $this->user_model->get_one(array('id'=>$memberid));
        //         $member_infos[] = $memberinfo;
        //     }
        // }
        if ($actorids){
            $member_infos = $this->user_model->get_users_by_projectid_notin($projectid, $actorids);
        }else{
            $member_infos = $this->user_model->get_users_by_projectid($projectid);
        }


        $data['other_actors'] = $member_infos;
        $data['taskid'] = $taskid;

        $this->load->view('teamwork/others/task_edit', $data);
        
    }

    function del(){
        $method = 'get';
        $userid = $this->userdata['userid'];
        $this->load->model('task_model');

        $projectid = $this->input->$method('projectid');
        $taskid = $this->input->$method('taskid');

        if (!$this->is_project_creator($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $this->verify_by_rule(array(
            'taskid'=> $userid,
            'projectid'=> $projectid,
            ),
            'task_edit_page');

        $taskname = $this->task_model->get_one(array('id'=>$taskid))['taskname'];

        $this->task_model->del(array('id'=>$taskid));

        // 写入trend
        $this->load->model('project_trend_model');
        $now = date('y-m-d h:i:s',time());
        $project_trend_rec = array(
            'eventinfo'=> '用户 '.$this->userdata['username'].' 删除了任务 '.$taskname,
            'createdate'=> $now,
            'projectid'=>$projectid,
            );
        $this->project_trend_model->save($project_trend_rec);

        redirect("project/show?projectid=".$projectid);
    }

    function edit(){
        $method = 'post';
        $userid = $this->userdata['userid'];
        $this->load->model('task_model');
        $this->load->model('task_actor_model');

        $taskname = $this->input->$method('taskname'); 
        $taskstatus = $this->input->$method('taskstatus'); 
        $deadline = $this->input->$method('deadline');
        $remark = $this->input->$method('remark');

        $taskid = $this->input->$method('taskid');
        $projectid = $this->input->$method('projectid');

        $this->verify_by_rule(array(
            'taskid'=>$taskid,
            'projectid'=> $projectid,
            'taskname'=> $taskname,
            'taskstatus'=>$taskstatus,
            'deadline'=>$deadline,
            'remark'=>$remark,
            ),
            'task_edit');

        if (!$this->is_project_member($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }


        $task_rec = array();

        // 手动检查
        if (!empty($remark)){
            $task_rec['remark']=$remark;
        }
        if (isset($taskname)){
            $task_rec['taskname'] = $taskname;
        }

        if (isset($taskstatus)){
            $task_rec['taskstatus'] = 1;
        }else{
            $task_rec['taskstatus'] = 0;
        }
        if ($deadline!==''){
            $task_rec['deadline'] = $deadline;
        }


        $this->task_model->update($task_rec, array('id'=>$taskid));


        $taskname = $this->task_model->get_one(array('id'=>$taskid))['taskname'];
        $this->load->model('project_trend_model');
        $now = date('y-m-d h:i:s',time());
        $project_trend_rec = array(
            'eventinfo'=> '用户 '.$this->userdata['username'].' 修改了任务 '.$taskname,
            'createdate'=> $now,
            'projectid'=>$projectid,
            );
        $this->project_trend_model->save($project_trend_rec);

        redirect("project/show?projectid=".$projectid);
    }
    function trans_task(){
        $this->load->model('task_model');
        $method = "get";
        $userid = $this->userdata['userid'];

        $projectid = $this->input->$method('projectid');
        $taskid = $this->input->$method('taskid');
        $new_stepstatus = $this->input->$method('new_stepstatus');

        $this->verify_by_rule(array(
            'taskid'=>$taskid,
            'projectid'=> $projectid,
            'stepstatus'=>$new_stepstatus,
            ),
            'trans_task');

        if (!$this->is_project_member($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $task_rec = array(
            'stepstatus'=>$new_stepstatus,
            );

        $taskname = $this->task_model->get_one(array('id'=>$taskid))['taskname'];
        
        $this->task_model->update($task_rec, array('id'=>$taskid));

        $this->load->model('project_trend_model');
        $now = date('y-m-d h:i:s',time());
        $project_trend_rec = array(
            'eventinfo'=> '用户 '.$this->userdata['username'].' 更改了任务状态 '.$taskname,
            'createdate'=> $now,
            'projectid'=>$projectid,
            );
        $this->project_trend_model->save($project_trend_rec);

        redirect("project/show?projectid=".$projectid);
    }
    function add_actor(){
        $method = 'get';
        $this->load->model('task_actor_model');
        $this->load->model('user_model');

        $taskid = $this->input->$method('taskid');
        $actorid = $this->input->$method('userid');

        $this->verify_by_rule(array(
            'taskid'=>$taskid,
            'userid'=> $actorid,
            ),
            'task_add_actor');

        // if (!$this->is_project_creator($projectid, $actorid)){
        //     show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        // }

        $this->_add_actor($taskid, $actorid);
        $_userinfo = $this->user_model->get_one(array('id'=>$actorid));

        $this->response_json(array('username'=> $_userinfo['username']));

    }
    private function _add_actor($taskid, $actorid){
        $task_actor_rec = array(
            'taskid'=>$taskid,
            'actorid'=>$actorid,
            );

        $this->task_actor_model->save($task_actor_rec);

    }

}
?>