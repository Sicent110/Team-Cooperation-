<?php
require_once 'my_controller.php';

class Share extends MyController{

    public function __construct(){
        parent::__construct();
        $this->load->model('share_model');
        
    }

    function add(){
        $userid = $this->userdata['userid'];
        $input = $this->input->post();

        $input['userid'] = $userid;

        $this->verify_by_rule($input, 'share_add');

        $now = date('y-m-d h:i:s',time());
        // $input['createdate'] = $now;

        $share_rec = array(
            'projectid'=>$this->input->post('projectid'),
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
            'createdate'=>$now,
            'ownerid'=>$userid,
        );

        $insert_id = $this->share_model->save($share_rec);

    }
    function show(){
        $userid = $this->userdata['userid'];

        $shareid = $this->input->get('shareid');

        $share = $this->share_model->get_one(array('id'=>$shareid));

        $this->response_json($share);

    }

}
