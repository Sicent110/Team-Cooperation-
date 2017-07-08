<?php

class MyController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->config->load('meta');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        $this->userdata = $this->session->userdata;
        $this->data['site_name'] = SITE_NAME;
        $this->my_map = array(
            'task_type'=>array(
                0=>'待处理',
                1=>'进行中',
                2=>'已完成',
                ),
            );

        $this->load->library('form_validation');
    }

    protected function is_signin($userdata){
        if (count($userdata) === 1){
            redirect("teamwork/signin");
        }
    }

    function response_json($arr){
        // $arr =array('a'=>'b',
        //     'c'=>array(
        //         'd','e'));
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arr);
    }

    function verify_by_rule($arr, $rule_name){
        $this->form_validation->set_data($arr);
        if ($this->form_validation->run($rule_name) == FALSE) {
            $error = validation_errors();
            // show_error($error, 404, $heading = 'An Error Was Encountered');
            echo $error;
            die;
        } 
    }

    function is_project_creator($projectid, $userid){
        $this->load->model('project_model');
        $res = $this->project_model->get_one(array('id'=>$projectid, 'ownerid'=>$userid));
        return $res;
    }
    function is_project_member($projectid, $userid){
        $this->load->model('project_actor_model');
        $res = $this->project_actor_model->get_one(array('projectid'=>$projectid, 'actorid'=>$userid));
        return $res;
    }
    function is_task_actor($taskid, $userid){
        $this->load->model('task_actor_model');
        $res = $this->task_actor_model->get_one(array('taskid'=>$taskid, 'actorid'=>$userid));
        return $res;
    }
}

function get_extension($file){
    return substr(strrchr($file, '.'), 1);
} 
function get_now(){
    $now = date('y-m-d h:i:s',time());
    return $now;
}
function my_array_diff($arr1, $arr2, $func){
    $new_arr = array();
}
















?>