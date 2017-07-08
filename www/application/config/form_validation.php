<?php

$username_rules = array('field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|min_length[3]|max_length[18]',);

$config = array(
    'signin'=>array(
        array('field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|min_length[3]|max_length[18]',),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required|trim|min_length[3]|max_length[18]',),
    ),
    'project'=>array(
        array('field' => 'projectid', 'label' => 'Projectid', 'rules' => 'required|trim|integer',),
    ),
    'project_add'=>array(
        array('field' => 'projectname', 'label' => 'Projectname', 'rules' => 'required|min_length[3]|max_length[18]',),
        array('field' => 'intro', 'label' => 'Intro', 'rules' => 'required|min_length[3]|max_length[255]',),
    ),

    'project_add_member'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'userid', 'label' => 'userid', 'rules' => 'required|trim|integer',),
    ),
    'task_add'=>array(
        array('field' => 'task_content', 'label' => 'task_content', 'rules' => 'required|trim|min_length[3]|max_length[255]',),
        array('field' => 'stepstatus', 'label' => 'stepstatus', 'rules' => 'required|trim|integer|regex_match[/[012]/]',),
        // 可以在规则中只验证部分字段
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'userid', 'label' => 'userid', 'rules' => 'required|trim|integer',),

    ),
    'task_edit_page'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'taskid', 'label' => 'taskid', 'rules' => 'required|trim|integer',),
    ),
    'task_edit'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'taskid', 'label' => 'taskid', 'rules' => 'required|trim|integer',),
        array('field' => 'taskname', 'label' => 'taskname', 'rules' => 'min_length[3]|max_length[18]',),
        // array('field' => 'taskstatus', 'label' => 'taskstatus', 'rules' => 'trim|integer|regex_match[/[01]/]',),
        array('field' => 'deadline', 'label' => 'deadline', 'rules' => 'trim|min_length[3]|max_length[50]',),
        array('field' => 'remark', 'label' => 'remark', 'rules' => 'min_length[3]|max_length[255]',),

    ),
    'trans_task'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'taskid', 'label' => 'taskid', 'rules' => 'required|trim|integer',),
        array('field' => 'stepstatus', 'label' => 'stepstatus', 'rules' => 'required|trim|integer|regex_match[/[012]/]',),
    ),
    'task_add_actor'=>array(
        array('field' => 'taskid', 'label' => 'taskid', 'rules' => 'required|trim|integer',),
        array('field' => 'userid', 'label' => 'userid', 'rules' => 'required|trim|integer',),
    ),
    'user_search'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        // $username_rules,
        array('field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|min_length[3]|max_length[18]', 
            array('required'=>'你必须输入{field}!')),

    ),
    'share_add'=>array(
        array('field' => 'projectid', 'label' => 'projectid', 'rules' => 'required|trim|integer',),
        array('field' => 'userid', 'label' => 'userid', 'rules' => 'required|trim|integer',),
        array('field' => 'title', 'label' => 'title', 'rules' => 'required|trim',),
        array('field' => 'content', 'label' => 'content', 'rules' => 'required|trim',),

    ),


);