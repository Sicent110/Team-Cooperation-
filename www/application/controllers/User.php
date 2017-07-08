<?php
require_once 'my_controller.php';

class User extends MyController{

    public function __construct(){
        parent::__construct();
        $config['upload_path']      = './static/img/avatar/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 1024;
        $config['max_width']        = 1024;
        $config['max_height']       = 1024;
        $config['overwrite'] = true;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->http_method = $_SERVER['REQUEST_METHOD'];
        // var_dump($_SERVER);
    }

    function account(){
        
    }

    public function set_avatar(){
        $this->is_signin($this->userdata);
        $data['is_signin'] = true;
        $data['site_name'] = SITE_NAME;

        // $file_name = $_FILES['avatar']["name"];
        // $file_ext = get_extension($file_name);
        // $new_name = $this->userdata["username"].'.'.$file_ext;

        if ( !$this->upload->do_upload('avatar')){
            $data['error']= $this->upload->display_errors();

            $this->load->view('templates/header', $data);
            $this->load->view('teamwork/account', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            // unlink()
            $this->db->update("users",
                array('avatar'=>$this->upload->data('file_name')), 
                array('id'=>$this->userdata["userid"]));

            $this->load->view('templates/header', $data);
            $this->load->view('teamwork/account', $data);
            $this->load->view('templates/footer', $data);
        }

    }
    function search(){
        $method = 'post';
        $this->load->model('user_model');

        $this->load->library('form_validation');

        $username = $this->input->$method('username');
        $data['projectid'] = $this->input->$method('projectid');

        $this->verify_by_rule(array(
            'projectid'=> $data['projectid'],
            'username'=>$username,
            ),
            'user_search');
        
        $res = $this->user_model->get_list(array('username'=>$username));
        $data['users'] = $res;
        // $this->response_json($res);
        $this->load->view('teamwork/others/search_user', $data);


    }

}
