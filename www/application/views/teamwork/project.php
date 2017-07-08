        


            <div class="row clearfix">

                <div class="col-md-9 column">
                    <div class="tabbable" id="tabs-358393">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                 <a href="#panel-913666" data-toggle="tab">任务</a>
                            </li>
                            <li>
                                 <a href="#panel-382012" data-toggle="tab">分享</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="panel-913666">
                                <!--tab1 begin -->
                                <div id="tab_task" class="row" style="display:inline">
                                    <!-- <div class="col-md-4 task_panel"> -->
                                    <div class="col-md-4" >
                                        <div class="thumbnail">
                                            <div class="caption task_panels" id="task_panels_id_0" >
                                                <h3 align="center">
                                                    待处理 
                                                </h3>

                                                <!-- <p align="center" id="task_submit_button"> -->
                                                     <!-- <a class="btn btn-primary" href="#">Action</a>  -->
                                                     <!-- <a id="modal-pending" href="#modal-container-pending" role="button" class="btn" data-toggle="modal">添加任务</a> -->

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" >
                                        <div class="thumbnail">
                                            <div class="caption task_panels" id="task_panels_id_1">
                                                <h3 align="center">
                                                    进行中
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" >
                                        <div class="thumbnail">
                                            <div class="caption task_panels" id="task_panels_id_2">
                                                <h3 align="center">
                                                    已完成
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- tab 1 end -->

                            <div class="tab-pane" id="panel-382012">

<!-- <div class="container">
    <div class="row clearfix"> -->
    <br>
        <div class="col-md-12 column">
            <div class="row clearfix">

                <div class="col-md-4 column">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <h3 class="panel-title">
                                Panel title
                            </h3>
                        </div> -->
                        <div class="panel-body">

                            <ul class="media-list" id="topic_list">

                                <a id="" href="#modal-add-share" role="button" class="btn btn-default" data-toggle="modal">添加分享</a>

                                <?php foreach ($shares as $share): ?>

                                <li class="media topic-list">
                                    <!-- <div class="pull-right">
                                        <span class="badge badge-info topic-comment"><a href="#">2</a></span>
                                    </div> -->
                                    <a href="#"onclick='(function(which){
                                        var url = "<?=site_url('share/show?shareid='.$share['id'] )?>";
                                        $.get(url, function(data, status){
                                            share_content = $("#share-content");
                                            ele1 = "<h2>"+data["title"]+"</h2>";
                                            ele2 = "<p>"+data["content"]+"</p>";
                                            share_content.empty();
                                            share_content.append($(ele1));
                                            share_content.append($(ele2));
                                        });
                                        }(this));'  shareid='<?=$share['id']?>'>
                                        <h4><?=$share['title']?></h4>
                                    </a>
                                    <div class="media-body">
                                        <p class="text-muted">
                                        <a class="media-left" href="#"><img class="img-rounded medium" src="<?php echo base_url();?>static/img/avatar/<?=$share['userinfo']['avatar']?>" alt="avatar" height="30" width="30"></a>
                                            <span><a href="#"><?=$share['userinfo']['username']?></a></span>&nbsp;•&nbsp;
                                            <span>创建时间</span>&nbsp;<?=$share['createdate']?>&nbsp;
                                        </p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <!-- <li class="divider"></li> -->

                            </ul>

                        </div>
                        <!-- <div class="panel-footer">
                            Panel footer
                        </div> -->
                    </div>
                </div>
                <div class="col-md-8 column" id='share-content'>
                    <h2>
                    </h2>
                    <p>
                    </p>
                    <p>
                         <!-- <a class="btn" href="#">View details »</a> -->
                    </p>
                </div>

            </div>
        </div>
    <!-- </div>
</div> -->



                            </div>
                        </div>
                    </div>

                </div>

                <br><br>
                <div class="col-md-3 column">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>
                                项目信息
                            </h3>
                            <!-- <span class="glyphicon glyphicon-asterisk"></span> -->
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                任务统计
                            </h3>
                        </div>
                        <div class="panel-body">
                            待处理(<?=$count[0][0]?> / <?=$count[0][1]?>)  
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    <?php if (intval($count[0][1])!==0): ?>
                                    style="width: <?=($count[0][0]/$count[0][1])*100?>%;">
                                    <?php else: ?>
                                    style="width: 0%;">
                                    <?php endif; ?> 
                                    <!-- <span class="sr-only">20% 完成（警告）</span> -->

                                </div>
                            </div>

                            进行中(<?=$count[1][0]?> / <?=$count[1][1]?>)   
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    <?php if (intval($count[1][1])!==0): ?>
                                     style="width: <?=($count[1][0]/$count[1][1])*100?>%;">
                                    <?php else: ?>
                                    style="width: 0%;">
                                    <?php endif; ?> 
                                </div>
                            </div>

                            已完成(<?=$count[2][0]?> / <?=$count[2][1]?>)
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    <?php if (intval($count[2][1])!==0): ?>
                                     style="width: <?=($count[2][0]/$count[2][1])*100?>%;">
                                    <?php else: ?>
                                    style="width: 0%;">
                                    <?php endif; ?> 
                                </div>
                            </div>

                        </div>


                        <div class="panel-heading">
                             <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-843934" href="#panel-element-event">项目动态</a>
                        </div>
                        <div id="panel-element-event" class="panel-collapse collapse">
                            <div class="panel-body">

                                <?php foreach ($project_trends as $trend): ?>

                                    <li><?=$trend['eventinfo']?></li>

                                <?php endforeach; ?>
                                
                            </div>
                        </div>


                        <!-- <div class="panel-footer">
                            Panel footer
                        </div> -->

                    <!-- <div class="panel panel-default"> -->
                        <div class="panel-heading">
                             <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-843934" href="#panel-element-member">项目成员</a>
                        </div>
                        <div id="panel-element-member" class="panel-collapse collapse">
                            <div class="panel-body">

<?php foreach ($members as $user_info): ?>

        <a href="#">
            <img src="<?php echo base_url();?>static/img/avatar/<?=$user_info['avatar']?>" alt='user_avatar' height="30" width="30"border="0" align="left"/>
            <?=$user_info['username']?>
        </a>
        <br><br>

<?php endforeach; ?>

                            </div>
                        </div>
                    <!-- </div> -->

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


