
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="<?php base_url(); ?>home"> 
                    <?php echo ucfirst($site_name); ?>
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                </div>
            </nav>


<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <div class="row clearfix">
        <div class="col-md-2 column">
        </div>
        <div class="col-md-6 column">


            <div class="tabbable" id="tabs-261036">
                <ul class="nav nav-tabs">
                    <li class="active">
                         <a href="#panel-621286" data-toggle="tab">登录</a>
                    </li>
                    <li>
                         <a href="#panel-390931" data-toggle="tab">注册</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="panel-621286">

                        <?php echo validation_errors(); ?>
                        <?php echo form_open('login/signin_submit'); ?>
                        <!-- <form class="form-horizontal" role="form"> -->
                          <div class="form-group">
                             <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="inputEmail3" type="text"  name="username" value="<?=set_value('username')?>"/>
                            </div>
                          </div>
                          <br/>
                          <br/>
                          <div class="form-group">
                             <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="inputPassword3" type="password" name="password" value="<?=set_value('username')?>"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="checkbox">
                                 <label><input type="checkbox" />Remember me</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <input class="btn btn-default" type="submit" name="submit" value="signin">
                               <!-- <button type="submit" class="btn btn-primary" value="signin">Sign in</button>
                               <button type="submit" class="btn btn-default" value="signup">Sign up</button> -->
                            </div>
                          </div>
                        </form>

                    </div>
                    <div class="tab-pane" id="panel-390931">

                        <?php echo validation_errors(); ?>
                        <?php echo form_open('login/signup_submit'); ?>
                        <!-- <form class="form-horizontal" role="form"> -->
                          <div class="form-group">
                             <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="inputEmail3" type="text"  name="username" value="<?=set_value('username')?>"/>
                            </div>
                          </div>
                          <br/>
                          <br/>
                          <div class="form-group">
                             <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="inputPassword3" type="password" name="password" value="<?=set_value('username')?>"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <br>
                              <input class="btn btn-default" type="submit" name="submit" value="signup">
                               <!-- <button type="submit" class="btn btn-primary" value="signin">Sign in</button>
                               <button type="submit" class="btn btn-default" value="signup">Sign up</button> -->
                            </div>
                          </div>
                        </form>

                    </div>
                </div>
            </div>


          


        </div>
        <div class="col-md-4 column">
        </div>
      </div>
    </div>
  </div>
</div>