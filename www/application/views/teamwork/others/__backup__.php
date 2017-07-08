

<a href="<?=site_url('api/add_task_actor?userid='.$_task_actor['id'].'&taskid='.$taskid  )?>"> </a>


<!-- modal -->
<div class="modal fade" id="modal-container-pending" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    标题
                </h4>
            </div>
            <div class="modal-body">
                内容...
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
        
    </div>
    
</div>
<!-- modal -->

<div class="dropdown" style="display:none;" align="center">
    <li class="dropdown" style="list-style-type:none;">
        <button data-toggle="dropdown" class="btn dropdown-toggle">添加任务</button>
        <ul class="dropdown-menu">
            <li>
                这是内容
            </li>
        </ul>
    </li>
</div>

<div class="container" style="display:none;">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Panel title
                    </h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
                <div class="panel-footer">
                    Panel footer
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="display:none;">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="tabbable" id="tabs-261036">
                <ul class="nav nav-tabs">
                    <li class="active">
                         <a href="#panel-621286" data-toggle="tab">Section 1</a>
                    </li>
                    <li>
                         <a href="#panel-390931" data-toggle="tab">Section 2</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="panel-621286">
                        <p>
                            I'm in Section 1.
                        </p>
                    </div>
                    <div class="tab-pane" id="panel-390931">
                        <p>
                            Howdy, I'm in Section 2.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
             <a id="modal-224688" href="#modal-container-224688" role="button" class="btn" data-toggle="modal">触发遮罩窗体</a>
            
            <div class="modal fade" id="modal-container-224688" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                标题
                            </h4>
                        </div>
                        <div class="modal-body">
                            内容...
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</div>