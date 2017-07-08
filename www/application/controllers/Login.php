<?php
require_once 'my_controller.php';

class Login extends MyController {
    private $pass = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        // $this->load->library('session');
        $this->config->load('meta');
        $this->load->library('form_validation');
    }
    public function signin() {
        $data['site_name'] = SITE_NAME;
        $this->_render_signin($data);
    }
    public function signin_submit() {
        $data['site_name'] = SITE_NAME;
        $this->load->model('user_model');

        $this->load->library('form_validation');
        // $this->form_validation->set_rules('username', 'Username', 'required');
        // $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run('signin') == FALSE) {
            $this->_render_signin($data);
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $userinfo = $this->user_model->get_one(array('username'=> $username));
            $passwd = $userinfo['password'];
            $userid = $userinfo['id'];

            if ($passwd !== "" && $passwd == $password) {
                $sessiondata = array(
                    'username' => $username,
                    'userip' => $_SERVER['REMOTE_ADDR'],
                    'luptime' => time(),
                    'login'=> true,
                    'userid'=> $userid,
                    );
                $this->session->set_userdata($sessiondata);
                redirect('project/lists');
            }else{
                $this->_render_signin($data);
            }

        } 
    }
    public function signup_submit(){
        $this->load->model('user_model');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $userdata = array(
            'username' => $username, 
            'password' => $password,
            // 'avatar'=> "default.jpeg",
            );
        $this->form_validation->set_data($userdata);
        if ($this->form_validation->run('signin') == FALSE) {
            $this->_render_signin($this->data);
            return ;
        }

        $userdata['avatar'] = 'default.jpg';

        $this->user_model->save($userdata);

        // echo '<meta http-equiv="refresh" content="3;URL='.site_url('teamwork/signin').'> '."注册成功！3秒后自动跳转 ";
        echo '<a href="'.site_url('signin').'"> '."注册成功！点击重新登录 ".'</a>';
    }
    private function _render_signin($data){
        $this->load->view('templates/header', $data);
        // $this->load->view('teamwork/_project_header', $data);
        $this->load->view('teamwork/login', $data);
        $this->load->view('templates/footer', $data);
    }
    public function signout(){
        $this->session->sess_destroy();
        // $this->_render_signin($data);
        redirect("signin", "refresh");
    }


}
