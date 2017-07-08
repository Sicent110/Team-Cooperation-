

<!-- 任务添加小框 -->
            <!-- <ul class="nav navbar-nav navbar-right"> -->
            <div class="dropdown _panel_button" id="task_submit_button" style="display: none;" align="center">
                <li class="dropdown" style="list-style-type:none;">
                    <button data-toggle="dropdown" class="btn dropdown-toggle button_pop_task_menu" data-stopPropagation="true" >添加任务</button>
                    <ul class="dropdown-menu">
                        <li>
                            <textarea placeholder="任务内容"></textarea>
                            <!-- <a href="#">操作</a> -->
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">参与者</a>

                            <!-- <a href="#" class="add-actor" userid=""></a> -->

                            <!-- <a href="#" style='display:inline-block;'>
                                添加
                                <span class="glyphicon glyphicon-plus"></span>      
                            </a> -->

                            <p id="member-divider"></p>

                            <!-- <a  style='display:inline-block;' href="#modal-add-new-actor" role="button" class="btn" data-toggle="modal" >添加</a> -->

                            <?php if (isset($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <label><input name="member" type="checkbox" value="<?=$member['id']?>" />  <?=$member['username']?></label> <br>
                                
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <!-- <label><input name="Fruit" type="checkbox" value="" />苹果 </label> <br>
                                <label><input name="Fruit" type="checkbox" value="" />桃子 </label> <br>
                                <label><input name="Fruit" type="checkbox" value="" />香蕉 </label> <br>
                                <label><input name="Fruit" type="checkbox" value="" />梨 </label> <br> -->


                        </li>

                        <br><br>
                        <li class="divider"></li>
                        <li>
                            <div align="center">
                                <button class="btn button_add_task">添加</button>
                            </div>
                        </li>
                    </ul>

                </li>

            </div>
            <!-- </ul> -->

<!-- 任务显示小框 -->
            <div class="panel panel-info" id="task_panel" style="display: none;">
            <!-- <div class="panel panel-warning" id="task_panel" style="display: none;"> -->
                <div class="panel-heading">

                    <div class="switch" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
                        <!-- <input type="checkbox" /> -->
                        <span>
                            <!-- id="modal-task"  -->
                             <a href="#modal-container-task" role="button" class="btn modal_task_button" data-toggle="modal" taskid="">task name</a>
                        </span>
                        <!-- class="thumbnail" -->
                        <!-- <a href="#"><img src="" alt='user_avatar' height="30" width="30"border="0" align="right"/></a> -->

                    </div>

                </div>
                <div class="panel-body">
                    <span class="label label-primary">截止日期</span>
                    <!-- 为子项目备留 -->
                    <!-- <span align="right">1/1</span> -->
                </div>
            </div>


<!-- modal -->
<!-- 任务编辑 -->
<div class="modal fade" id="modal-container-task" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="checkbox" />
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <span id='task_name'>

                </span>

<!--                 <span>
                    <ul class="nav navbar-nav ">
                        <li class="dropdown">
                            <a href="#" role="button" class="btn" data-toggle="dropdown" >待处理</a>
                            <ul class="dropdown-menu">
                                <li>
                                     <a href="#">操作</a>
                                </li>
                                <li class="disabled">
                                     <a href="#">另一操作</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="#">其它</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </span> -->

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <button data-toggle="dropdown" align="right" class="btn dropdown-toggle">操作</button>
                        <ul class="dropdown-menu">
                            <li>
                                 <a href="#" id="delete_task">删除任务</a>
                            </li>

                        </ul>
                    </li>
                </ul>

                <!-- <h4 class="modal-title" id="myModalLabel">
                    标题
                </h4> -->
            </div>
            <div class="modal-body">
                <textarea id='task_remark' placeholder="请在此输入任务备忘"></textarea>
                <!-- <button class="btn" style="float:right" onclick="function(){}">添加</button> -->
            </div>

            <div class="list-group">
                 <!-- <a href="#" class="list-group-item active">Home</a> -->
                <div class="list-group-item">
                    参与者
                    <!-- <a class="btn" href="#">添加</a>  -->

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <button data-toggle="dropdown" class="btn dropdown-toggle">添加</button>
                            <ul class="dropdown-menu">
                                <li>
                                     <a href="#">操作</a>
                                </li>
                                <li class="disabled">
                                     <a href="#">另一操作</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="#">其它</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <div class="list-group-item">
                    截止日期
                    <!-- readonly  -->
                    <input id="input-timepicker" size="16" type="text" value="2012-06-15 14:45" class="form_datetime" onclick="call_picker();" style="float:right">

                </div>
                <div class="list-group-item">
                    优先级
                </div>
                <div class="list-group-item">
                    动态

                </div>

                <!-- <div class="list-group-item">
                     <span class="badge">14</span> Help
                </div> <a class="list-group-item active"> <span class="badge">14</span> Help</a> -->
            </div>


            <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
                 <!-- <button type="button" class="btn btn-primary">保存</button> -->
                 <input type="submit" name="submit">
            </div>
        </div>
        
    </div>
    
</div>
<!-- modal -->

<!-- 添加新项目 -->
<div class="modal fade" id="modal-container-add-new-project" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    新项目
                </h4>
            </div>
            <div class="modal-body">
            <div class="row clearfix">
            <div class="col-md-12 column">
                <?php echo validation_errors(); ?>
                <?php echo form_open('project/add'); ?>
                <!-- <form class="form-horizontal" role="form"> -->
                    <div class="form-group">
                         <!-- <label for="inputEmail3" class="col-sm-2 control-label">Email</label> -->
                        <div class="col-sm-12">
                            <input class="form-control" id="projectname" type="text" placeholder="项目名称" name="projectname"/>
                        </div>
                    </div>
                    <div class="form-group">
                         <!-- <label for="inputPassword3" class="col-sm-2 control-label">Password</label> -->
                        <div class="col-sm-12">
                            <input class="form-control" id="intro" type="text" placeholder="项目说明" name="intro"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-12">
                            <input class="btn btn-default" type="submit" name="submit" value="提交">
                             <!-- <button type="submit" class="btn btn-default">提交</button> -->
                        </div>
                    </div>
                </form>
            </div>
            </div>
            </div>
            <!-- <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
            </div> -->
        </div>
        
    </div>
</div>



<!-- 错误显示 -->
<a id="modal-error-info" href="#modal-error-info-div" role="button" class="btn" data-toggle="modal"></a>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <div class="modal fade" id="modal-error-info-div" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                错误
                            </h4>
                        </div>
                        <div class="modal-body">
                            内容:

                            <?php if (isset($error)){
                                echo $error;
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
                             <!-- <button type="button" class="btn btn-primary">保存</button> -->
                        </div>
                    </div>
                    
                </div>
                
            </div>

        </div>
    </div>
</div>            


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <div class="modal fade" id="modal-add-new-actor" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                当前项目的参与者:
                            </h4>
                        </div>


                                <ul class="menu">

                                    <?php if (isset($members)): ?>
                                    <?php foreach ($members as $member): ?>
                                        <li>
                                            <a href="#" onclick='(function(which){
                                                var url = "#";
                                                $.get(url, function(data, status){
                                                    var ele = "<a href=\"#\" style=\"display: inline;\">" + data["username"] + "</a>";
                                                    $("#member-divider").before($(ele));
                                                });
                                                }(this));'>

                                                <?=$member['username']?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                </ul>

                        <!-- <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
                        </div> -->
                    </div>
                    
                </div>
                
            </div>

        </div>
    </div>
</div>   



<div class="modal fade" id="modal-container-add-new-member" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    添加新成员
                </h4>
            </div>
            <!-- <div class="modal-body"> -->

                <!-- <div class="panel panel-default"> -->

                    <div class="panel-body">

                        <?php echo validation_errors(); ?>
                        <?php echo form_open('', array('id'=>'user-search-form', 'class'=>'form-search')); ?>
                            <!-- <input class="form-control" id="inputPassword3" type="text" name="user_search" value="" placeholder="请在此输入用户名" style="display:inline;">
                            <button type="submit" class="btn btn-primary" style="display:inline;">查找</button> -->

                            <input type="submit" value="查找" style="float: right" class="button"/>
                            <div style="overflow: hidden; padding-right: .5em;">
                               <input type="text" style="width: 100%;" name="username" placeholder="请在此输入用户名" class="input-medium search-query"/>
                            </div>

                        </form>

                    </div>

                <!-- </div> -->

            <!-- </div> -->
            <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
        
    </div>
    
</div>

<script type="text/javascript">

$('#user-search-form').on('submit',function(e){
    e.preventDefault();
    $(this).nextAll().remove();

    var string = $(this).serialize();
    string = string + '&projectid=' + String(window.projectid);
    $.ajax({
        type:"post",
        url:"<?=site_url('user/search')?>",
        data: string,
        success:function (data) {
            // console.info("返回值:");
            // console.log(data);
            $('#user-search-form').after($(data));
        }
    });
})

</script>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            
            <div class="modal fade" id="modal-add-share" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                添加分享 
                            </h4>
                        </div>
                        <div class="modal-body">

        <div class="setting">
            <form accept-charset="UTF-8" action="" class="form-horizontal" method="post" id="add-new-share">
                <input type="hidden" name="stb_csrf_token" value="dbf48d6a9c0fbf9c53dd1f8c4c525c12">
                
                <div class="form-group">
                    <label class="col-md-2 control-label" for="title">标题</label>
                    <div class="col-md-6">
                    <input class="form-control" id="title" name="title" size="50" type="text" value="" />
                    <span class="help-block red"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label" for="content">内容</label>
                    <div class="col-md-6">
                    <textarea class="form-control" cols="40" id="content" name="content" rows="5"></textarea>
                    <span class="help-block red"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-6">
                        <button type="submit" class="btn btn-primary" >保存</button>
                    </div>
                </div>
            </form>
        </div>

                        </div>
                        <!-- <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
                        </div> -->
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">

$('#add-new-share').on('submit',function(e){
    e.preventDefault();
    // $(this).nextAll().remove();

    var string = $(this).serialize();
    string = string + '&projectid=' + String(window.projectid);
    $.ajax({
        type:"post",
        url:"<?=site_url('share/add')?>",
        data: string,
        success:function (data) {
            // console.info("返回值:");
            // console.log(data);
            // $('#user-search-form').after($(data));
        }
    });
})

</script>














