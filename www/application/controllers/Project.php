<?php
require_once 'my_controller.php';

class Project extends MyController{

    public function __construct(){
        parent::__construct();
    }

    function lists(){
        // $userdata = $this->session->userdata;
        $this->load->model('project_model');
        $this->load->model('project_actor_model');
        $this->load->model('user_model');

        $data['site_name'] = SITE_NAME;
        $data['username'] = $this->userdata["username"];
        $userid = $this->userdata['userid'];

        $project_infos = $this->project_model->get_projects_by_userid($userid);

        if (false){
            $data['projects'] = array();
            $data['error'] = $ret['res'];
            
        }else{
            $data['projects'] = $project_infos;
        }

        $data['userinfo'] = $this->user_model->get_one(array('id'=>$userid));
        $data['is_project_lists_page'] = true;

        $this->load->view('templates/header', $data);
        $this->load->view('teamwork/_project_header', $data);
        $this->load->view('teamwork/projects', $data);
        $this->load->view('teamwork/_modals', $data);
        $this->load->view('templates/footer', $data);
    }
    function show(){
        //检查用户是否属于此项目
        //...

        $this->load->model('project_model');
        $this->load->model('project_actor_model');
        $this->load->model('task_model');
        $this->load->model('user_model');
        $this->load->model('project_trend_model');
        $this->load->model('share_model');

        $method = 'get';
        $projectid = $this->input->$method('projectid');
        $userid = $this->userdata['userid'];

        // 检查输入
        $this->form_validation->set_data(array('projectid'=>$projectid));
        if ($this->form_validation->run('project') == FALSE) {
            $error = validation_errors();
            $this->load->view('teamwork/error', array('error'=>$error));
            return ;
        } 

        // 检查用户权限
        if (!$this->is_project_member($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $data['is_signin'] = true;
        $data['site_name'] = SITE_NAME;

        $projectinfo = $this->project_model->get_one(array('id'=> $projectid));
        $data['projectinfo'] = $projectinfo;
        
        $project_infos = $this->project_model->get_projects_by_userid($userid);

        $otherprojects = array_filter($project_infos, function($projectinfo) use ($data){
            return $projectinfo['id'] !== $data['projectinfo']['id'];
        });

        $data['otherprojects'] = $otherprojects;

        $data['count'] = $this->project_model->count($projectid);

        $member_infos = $this->user_model->get_users_by_projectid($projectid);

        $data['members'] = $member_infos;
        $data['userinfo'] = $this->user_model->get_one(array('id'=>$userid));

        $data['tasks'] = $this->_task_lists($projectid);

        $data['project_trends'] = $this->project_trend_model->get_list(array('projectid'=>$projectid));

        $shares = $this->share_model->get_list(array('projectid'=>$projectid));
        // foreach ($shares as $share) {
        //     $_userid = $share['ownerid'];
        //     $_userinfo = $this->user_model->get_one(array('id'=>$_userid));
        //     $share['userinfo']= $_userinfo;
        // }
        for ($i=0; $i < count($shares); $i++) { 
            $_userid = $shares[$i]['ownerid'];

            $_userinfo = $this->user_model->get_one(array('id'=>$_userid));
            $shares[$i]['userinfo'] = $_userinfo;
        }

        $data['shares'] = $shares;

        $this->load->view('templates/header', $data);
        $this->load->view('teamwork/_project_header', $data);
        $this->load->view('teamwork/project', $data);
        $this->load->view('teamwork/_modals', $data);
        $this->load->view('templates/footer', $data);
    }

    function add(){
        $method = 'post';
        $this->load->model('project_model');
        $this->load->model('project_actor_model');

        $this->load->library('form_validation');

        $userid = $this->userdata['userid'];
        $projectname = $this->input->$method('projectname');
        $intro = $this->input->$method('intro');

        // $projectname = $this->input->$method('projectname');
        // $intro = $this->input->$method('intro');

        $this->form_validation->set_data(array(
            'projectname'=>$projectname,
            'intro'=>$intro,
            ));

        if ($this->form_validation->run('project_add') == FALSE) {
            $error = validation_errors();
            echo $error;
            return ;
        } 

        // if ($this->form_validation->run() == FALSE) {
        //     // redirect('project/lists');
        //     echo "invalid submit!";
        else {
            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                $now = date('y-m-d h:i:s',time());
                $project_info = array(
                    'projectname'=> $projectname,
                    'intro'=> $intro,
                    'ownerid'=> intval($this->userdata['userid']),
                    'createdate'=> $now,
                    );
                
                $insert_id = $this->project_model->save($project_info, $userid);

                // 写入trend
                $this->load->model('project_trend_model');
                $project_trend_rec = array(
                    'eventinfo'=> '用户 '.$this->userdata['username'].' 创建项目 '.$projectname,
                    'createdate'=> $now,
                    'projectid'=>$insert_id,
                    );
                $this->project_trend_model->save($project_trend_rec);
               
                redirect('project/lists');

            }
        }

    }

    function add_member(){
        $this->load->model('project_model');
        $method = 'get';
        $userid = $this->userdata['userid'];

        $projectid = $this->input->$method('projectid');
        $actorid = $this->input->$method('userid');


        $this->form_validation->set_data(array(
            'projectid'=>$projectid,
            'userid'=>$actorid,
        ));
       
        if ($this->form_validation->run('project_add_member') == FALSE) {
            $error = validation_errors();
            echo $error;
            return ;
        } 
        if (!$this->is_project_creator($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        $this->project_model->add_actor( $actorid, $projectid);

        $this->load->model('user_model');
        $username = $this->user_model->get_one(array('id'=>$actorid))['username'];

        // 写入trend
        $this->load->model('project_trend_model');
        $now = date('y-m-d h:i:s',time());
        $project_trend_rec = array(
            'eventinfo'=> '用户 '.$this->userdata['username'].' 添加项目成员 '.$username,
            'createdate'=> $now,
            'projectid'=>$projectid,
            );
        $this->project_trend_model->save($project_trend_rec);

        redirect('project/show?projectid='.$projectid);
    }

    function del(){
        $userid = $this->userdata['userid'];
        
        $this->load->model('project_model');
        $method = 'get';
        $projectid = $this->input->$method('projectid');

        $this->form_validation->set_data(array(
            'projectid'=>$projectid,
        ));

        if (!$this->is_project_creator($projectid, $userid)){
            show_error('权限不足', 404, $heading = 'An Error Was Encountered');
        }

        if ($this->form_validation->run('project') == FALSE) {
            $error = validation_errors();
            echo $error;
            return ;
        } 
        $this->project_model->del(array('id'=> $projectid), $projectid);
        redirect('project/lists');
    }

    private function _task_lists($projectid){
        $this->load->model('task_model');
        $this->load->model('project_actor_model');
        $userid = $this->userdata['userid'];
        // $projectid = $this->input->get('projectid');

        // 可抽象
        // if (!$this->project_actor_model->is_exists($userid, $projectid)){
        //     $error['error'] = "你不属于当前项目";
        //     $this->load->view('teamwork/error', $error);
        // } 

        $tasks = $this->task_model->get_list(array('projectid'=>$projectid));
        // $this->response_json($tasks);
        return $tasks;
    }    

}
?>
















