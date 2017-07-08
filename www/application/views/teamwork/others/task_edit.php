
<!-- <div class="modal fade" id="modal-container-task" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
<style type="text/css">  
    .dropdown-submenu {  
        position: relative;  
    }  
    .dropdown-submenu > .dropdown-menu {  
        top: 0;  
        left: 100%;  
        margin-top: -6px;  
        margin-left: -1px;  
        -webkit-border-radius: 0 6px 6px 6px;  
        -moz-border-radius: 0 6px 6px;  
        border-radius: 0 6px 6px 6px;  
    }  
    .dropdown-submenu:hover > .dropdown-menu {  
        display: block;  
    }  
    .dropdown-submenu > a:after {  
        display: block;  
        content: " ";  
        float: right;  
        width: 0;  
        height: 0;  
        border-color: transparent;  
        border-style: solid;  
        border-width: 5px 0 5px 5px;  
        border-left-color: #ccc;  
        margin-top: 5px;  
        margin-right: -10px;  
    }  
    .dropdown-submenu:hover > a:after {  
        border-left-color: #fff;  
    }  
    .dropdown-submenu.pull-left {  
        float: none;  
    }  
    .dropdown-submenu.pull-left > .dropdown-menu {  
        left: -100%;  
        margin-left: 10px;  
        -webkit-border-radius: 6px 0 6px 6px;  
        -moz-border-radius: 6px 0 6px 6px;  
        border-radius: 6px 0 6px 6px;  
    }  
</style>  


    <div class="modal-dialog">
        <div class="modal-content">

            <?php echo validation_errors(); ?>
            <?php echo form_open('task/edit'); ?>

            <div class="modal-header">
                <?php if ($task_rec['taskstatus']=== '1'): ?>
                    <input type="checkbox" name="taskstatus" checked="" />
                <?php else: ?>
                    <input type="checkbox" name="taskstatus" />
                <?php endif; ?>

                <input type="hidden" name="taskid" value="<?=$task_rec['id']?>">
                <input type="hidden" name="projectid" value="<?=$task_rec['projectid']?>">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <span id='task_name' onclick="(function(which){$(which).replaceWith('<input value=\'' + $(which).text() + '\' ' + ' name=\'taskname\'>');}(this))">   <?=$task_rec['taskname']?></span>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <button data-toggle="dropdown" align="right" class="btn dropdown-toggle">操作</button>
                        <ul class="dropdown-menu">
                            <li>
                                 <a href="<?=site_url('task/del?projectid='.$projectid.'&taskid='.$task_rec['id'])?>" id="delete_task">删除任务</a>
                            </li>
                            <li class="dropdown-submenu">  
                                <a href="#">移动任务 </a>  
                                <ul class="dropdown-menu">  
                                    <?php 
                                        $stepstatus = intval($task_rec['stepstatus']);
                                        
                                        for ($i=0;$i<3;$i++){
                                            if ($stepstatus===$i){
                                                continue;
                                            }

                                            $new_stepstatus = strval($i);
                                            $url = site_url('task/trans_task?projectid='.$projectid.'&taskid='.$task_rec['id'].'&new_stepstatus='.$new_stepstatus);
                                            echo '<li><a href="'.$url.'">转移到：'.$task_type[$new_stepstatus].'</a></li>';

                                        }
                                    ?>

                                </ul>     
                            </li>  
                            <!-- <li class="disabled">
                                 <a href="#">移动任务</a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                 <a href="#">复制任务</a>
                            </li> -->
                        </ul>
                    </li>
                </ul>

                <!-- <h4 class="modal-title" id="myModalLabel">
                    标题
                </h4> -->
            </div>
            <div class="modal-body">
                <textarea id='task_remark' placeholder="请在此输入任务备忘" width="525px" style="width: 536px; height: 56px;" name="remark"><?=$task_rec['remark']?></textarea>
                <!-- <button class="btn" style="float:right" onclick="function(){}">添加</button> -->
            </div>

            <div class="list-group">
                 <!-- <a href="#" class="list-group-item active">Home</a> -->
                <div class="list-group-item">
                    参与者
                    <!-- <a class="btn" href="#">添加</a>  -->

                    <br>
                    <?php foreach ($task_actors as $_task_actor): ?>
                        <a href="#" style="display: inline;">
                            <?=$_task_actor['username']?>
                        </a>
                    <?php endforeach; ?>
                    
                    <p id="actor-divider"></p>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <button data-toggle="dropdown" class="btn dropdown-toggle">添加</button>
                            <ul class="dropdown-menu">

                                    <?php foreach ($other_actors as $_task_actor): ?>
                                        <li>
                                            <a href="#" onclick='(function(which){
                                                var url = "<?=site_url('task/add_actor?userid='.$_task_actor['id'].'&taskid='.$taskid  )?>";
                                                $.get(url, function(data, status){
                                                    var ele = "<a href=\"#\" style=\"display: inline;\">" + data["username"] + "</a>";
                                                    $("#actor-divider").before($(ele));
                                                });
                                                }(this));'>

                                                <?=$_task_actor['username']?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                
                            </ul>
                        </li>
                    </ul>
                            <br><br>

                </div>
                <div class="list-group-item">
                    截止日期：<?=$task_rec['deadline']?>
                    <!-- readonly  -->
                    <input id="input-timepicker" size="16" type="text" value="<?=$task_rec['deadline']?>" class="form_datetime" onclick="call_picker();" style="float:right" name="deadline">

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
                 <button type="submit" class="btn btn-primary">保存</button>
                 <!-- <input type="submit" name="submit" value="update"> -->
            </div>

            </form>

        </div>
        
    </div>
    
<!-- </div> -->