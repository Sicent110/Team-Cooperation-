<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">
                     <?php echo ucfirst("teamwork"); ?>
                     </a>
                </div>
            </nav>

            <div class="row clearfix">

                <div class="col-md-4 column">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <ul class="media-list" id="topic_list">
                                <li class="media topic-list">
                                    <!-- <div class="pull-right">
                                        <span class="badge badge-info topic-comment"><a href="#">2</a></span>
                                    </div> -->
                                    <a href="#"><h4>个人信息</h4></a>
                                    
                                </li>
                                <li class="divider"></li>

                                <li class="media topic-list">
                                    <a href="#"><h4>账号密码</h4></a>
                                </li>

                            </ul>

                        </div>
                        <!-- <div class="panel-footer">
                            Panel footer
                        </div> -->
                    </div>
                </div>

                <div class="col-md-8 column">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <form name="input" action="html_form_action.php" method="get">
                            Username: <input type="text" name="user">
                            <!-- Username: <input type="text" name="user"> -->
                            <br>
                            <input type="submit" value="Submit">
                            </form> 


                            <?php 
                                if(isset($error)){
                                    echo $error;}
                            ?>
                            <?php echo form_open_multipart('teamwork/avatar_upload');?>
                            <input type="file" name="avatar" size="20" />
                            <br /><br />
                            <input type="submit" value="upload" />
                            </form>

                        </div>
                    </div>
                </div>

            </div>







        </div>
    </div>
</div>