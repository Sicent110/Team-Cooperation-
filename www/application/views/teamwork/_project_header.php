
<script src="<?php echo base_url() ?>static/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>static/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css"/>
<script src="<?php echo base_url() ?>static/js/myjs.js"></script>

<script type="text/javascript">
    // alert(getNowFormatDate());
</script>

<script type="text/javascript">
function addTask(){
    // 1、插入数据库
    // if success
    var task_info = getTask($(this));
    task_info['projectid'] = window.projectid;
    task_info['stepstatus'] = $(this).attr("panels_id");

    var add_url = "<?php echo site_url('task/add') ?>";

    taskid = "";

    // 發送任務信息，并生成任務panel顯示
    function _bibao(task_info, add_url, which){
        $.ajax({
            url: add_url,
            type: 'POST',
            dataType:'json',
            timeout: 1000 * 10,
            // contentType: '"application/json; charset=utf-8"',
            data: task_info,
            success:function(res) {
                console.log(res);
                taskid = res['taskid'];

                var new_panel = $("#task_panel").clone();
                var button_ele = new_panel.find('a.modal_task_button');
                button_ele.text(task_info['task_content']);
                console.log(taskid);
                button_ele.attr('taskid', taskid);

                new_panel.removeAttr('id');
                new_panel.css("display", "");

                // 根据当前元素拿到父级_panel_button
                // var DOM=document.getElementsByClassName("_panel_button");
                var DOM=document.getElementsByClassName("task_panels");
                var p = $(which).parentsUntil(DOM).last();
                p.before(new_panel);

            }
        });

    }
    _bibao(task_info, add_url, this);

}

function init_panels(task_info){
    var new_panel = $("#task_panel").clone();
    var taskname_ele = new_panel.find('a.btn.modal_task_button');
    taskname_ele.text(task_info['taskname']);
    taskname_ele.attr('taskid', task_info['id']);

    if (parseInt(task_info['taskstatus'])!==0){
        new_panel.find('input').attr("checked", '');
    }
    var deadline = task_info['deadline']?task_info['deadline']:''
    var deadline_str = '截止时间：' + deadline;
    // new_panel.find('span.label.label-primary').text(deadline_str);
    new_panel.find('span.label').text(deadline_str);

    // user_avatar = null;
    // new_panel.find('img').attr('src', user_avatar);

    var panels_map ={
        0:"#task_panels_id_0",
        1:"#task_panels_id_1",
        2:"#task_panels_id_2",
    }
    var panels_id = panels_map[parseInt(task_info['stepstatus'])];

    var add_panel_button = $(panels_id).find('._panel_button');

    // 处理时间和颜色
    if ((task_info['deadline']!=="")&&(task_info['deadline']!==null)){
        var deadline_stamp = str2stamp(task_info['deadline']);
        var now_stamp = get_now_stamp();
        var delta = deadline_stamp-now_stamp;

        if ((0 < delta)&&(delta < 86400)){
            new_panel.find("span.label").attr("class", 'label label-warning')
        }else if(delta<=0){
            new_panel.find("span.label").attr("class", 'label label-danger')
        }
    }
    
    // 改变panel的颜色
    if (parseInt(task_info['taskstatus'])===1){
        new_panel.attr("class", "panel panel-default");
        new_panel.find("span.label").attr("class", 'label label-default')
        new_panel.find('a').attr('style', 'color:gray;');
    }

    new_panel.removeAttr('id');
    new_panel.css("display", "");
    add_panel_button.before(new_panel);

}
function fillupTaskPanels(){
    var get_url = "<?php echo site_url('task/lists?projectid=') ?>" + window.projectid;
    $.get(get_url, function(data, status){
        console.log(data);
        
        for(var ind in data){
            var task_info = data[ind];
                // if (parseInt(task_info['stepstatus'])===0){
            init_panels(task_info);
        }

    });

}

function load_task(which){
        // var task_ctn = $("div #modal-container-task");
    // $task_name_ele = task_ctn.find('span#task_name');
    
    // 從服務端直接獲取加載完畢的HTML
    var get_url = "<?php echo site_url('task/edit_page') ?>" + '?projectid=' + window.projectid + '&taskid=' + $(which).attr('taskid');
    $.get(get_url, function(data, status){
        var task_ctn = $('#modal-container-task');
        task_ctn.empty();
        task_ctn.append($(data));
        // empty会去掉事件绑定，需要重新绑定
        // $(".form_datetime").attr("value", getNowFormatDate());
    });
}

$(function() {
    // $(".modal_task_button").click(changeTimeValue);
    $(".modal_task_button").attr("onclick", "load_task(this);");
    // $(".modal_task").attr("onclick", "changeTimeValue();");
    $(".button_pop_task_menu").click(wipePlaceholder);

    // 增加‘添加按钮’，在button上绑定panels_id，
    for(var i=0; i<3; i++){
        var add_task_ele = $("#task_submit_button").clone();
        var _id = String(i);
        add_task_ele.find('button.button_add_task').attr("panels_id", _id);
        add_task_ele.removeAttr('id');
        add_task_ele.css("display", "inline");
        $("#task_panels_id_" + _id).append(add_task_ele);

    }
    // var add_task_ele = $("#task_submit_button").clone();
    // add_task_ele.css("display", "inline");
    // $(".task_panels").append(add_task_ele);
    
    $(".button_add_task").click(addTask);
    
    <?php if (isset($error)): ?>
        $("#modal-error-info").click();
    <?php endif; ?>  

    // 防止任务添加小窗口自动消除
    $(document).on('click', '._panel_button .dropdown-menu', function (e) {
        e.stopPropagation();
    });

    if (window.projectid){
        fillupTaskPanels();
    }

})

</script>    

  

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="<?=site_url('project/lists')?>"> 
                    <?php echo ucfirst($site_name); ?>
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active">
                             <a href="#">Link</a>
                        </li>
                        <li>
                             <a href="#">Link</a>
                        </li> -->
                        <li class="dropdown active" >
                            <?php if (isset($projectinfo)): ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$projectinfo['projectname']?><strong class="caret"></strong></a>
                                <script type="text/javascript">window.projectid=<?=$projectinfo['id']?></script>
                            <?php endif; ?>
                            <ul class="dropdown-menu">
                                <?php foreach ($otherprojects as $projectinfo): ?>
                                    <li>
                                         <a href="<?=site_url('project/show?projectid='.strval($projectinfo['id']))?>"><?=$projectinfo['projectname']?></a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </li>

                        <?php if (!isset($is_project_lists_page)): ?>
                        <li class="dropdown" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">添加<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <!-- <li>
                                     <a href="#" class="btn">任务</a>
                                </li>
                                <li>
                                     <a href="#" class="btn">分享</a>
                                </li> -->
                                <li>
                                    <a id="" href="#modal-container-add-new-member"  class="btn" data-toggle="modal">新成员</a>
                                </li>
                            </ul>
                            </ul>
                        </li>
                        <?php endif; ?>

                    </ul>
                    <!-- <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input class="form-control" type="text" />
                        </div> <button type="submit" class="btn btn-default">Submit</button>
                    </form> -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                             <a href="#"><img src="<?php echo base_url();?>static/img/avatar1.jpeg" alt='user_avatar' height="30" width="30"border="0" align="left"/></a>
                        </li> -->
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('static/img/avatar/'.$userinfo['avatar']);?>" alt='user_avatar' height="30" width="30"border="0" align="left"/><?=$userinfo['username']?></a>
                             

                            <ul class="dropdown-menu">
                                <li>
                                     <a href="#">个人资料</a>
                                </li>
                                <!-- <li>
                                     <a href="#">Another action</a>
                                </li>
                                <li>
                                     <a href="#">Something else here</a>
                                </li> -->
                                <li class="divider">
                                </li>       
                                <li>
                                     <a href="<?=site_url()?>/login/signout">退出登录</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">设置<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                     <a href="#">个人资料</a>
                                </li>
                                <li>
                                     <a href="#">Another action</a>
                                </li>
                                <li>
                                     <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>

