<!--   ----------------------  Start  Header Content -----------------------    -->
<div class="container" style="background: #ffffff;">    
    <div class="img-responsive center-block pull-left" style="margin-top: 15px;"><img class="img-responsive center-block" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/samarthya-logo.jpg" alt="samarthya" /></div>
    <div class="img-responsive center-block pull-right"><img class="img-responsive center-block" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/emblem-img.jpg" alt="Indian Emblem" /></div>
</div>
<!--   ---------------------- End  Header Content -----------------------    -->

<!--   ---------------------- Start  Navigation -----------------------    -->

<nav class="navbar navbar-default">
    <div class="container">   
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?php if (Yii::app()->user->getState("menu") == "home") { ?>active <?php } ?>">
                    <?php if (isset(Yii::app()->user->memId)) { ?>
                        <a href="<?php echo Yii::app()->request->baseUrl . '/site/landing'; ?>">Home</a>
                    <?php } else { ?>
                        <a href="<?php echo Yii::app()->request->baseUrl . '/site/index'; ?>">Home</a>
                    <?php } ?>
                </li>
                <?php if (isset(Yii::app()->user->memId)) { ?>
                    <li class="<?php if (Yii::app()->user->getState("menu") == "testResults") { ?>active <?php } ?>" ><a href="<?php echo Yii::app()->request->baseUrl . '/site/testRelutsMember'; ?>">Test Results</a></li>
                    <li class="<?php if (Yii::app()->user->getState("menu") == "visitedcourse") { ?>active <?php } ?>" ><a href="<?php echo Yii::app()->request->baseUrl . '/site/visitedCourse'; ?>">Visited Courses</a></li>
                <?php } else { ?>                
                    <li class="<?php if (Yii::app()->user->getState("menu") == "reports") { ?>active <?php } ?>" ><a href="<?php echo Yii::app()->request->baseUrl . '/site/reports'; ?>">Reports</a></li>
                <?php } ?>
            </ul>
            <?php if (isset(Yii::app()->user->memname)) { ?>
                <ul class="nav navbar-nav navbar-right right-margin">
                    <li class="user-info">Welcome  <span class="user-name" style="color:orange;font-weight: bold;"><?php
            if (isset(Yii::app()->user->firstname)) {
                echo Yii::app()->user->firstname;
            }
                ?></span></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/logout'; ?>">Logout</a></li>
                    <li class="active dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon-cog"></span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/changePassword'; ?>">Change Password</a></li>
                        </ul>
                    </li>
                    <li class="" id="imageupload"><a href="#" style="padding-top: 10px; padding-bottom: 10px;"  data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php
                            $user = User::model()->findByPk(Yii::app()->user->memId);
                            if (isset($user->profilePic) && !empty($user->profilePic)) {
                                $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/' . $user->profilePic;
                            } else {
                                $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/user.jpg';
                            }
                            ?>

                            <img src="<?php echo $profilePic; ?>" style="width: 30px; height: 30px;">
                        </a>
                        <ul class="dropdown-menu" role="" style="padding-left: 15px;">
                            <li class="" style="width: 200px;">

                                <!-- Update Password -->
                                <div id="updatePwd" style="width: 200px;">
                                    <img class="img-responsive"src="<?php echo $profilePic; ?>" style="width: 100px; height: 100px;">
                                    <form action="<?php echo Yii::app()->request->baseUrl . '/site/uploadProfilePic' ?>" method="post" enctype="multipart/form-data" style="width: 200px;" >
                                        <div  id="label" style="width: 200px;">   
                                            <input type="file" class="pull-left" name="profilePic" id="profilePic" style="width: 100%;" onchange="selectimage()"> 
                                            <br/><br/>
                                            <input type="submit" class="btn btn-success" value="Upload" name="submit"/>
                                        </div><br/>

                                    </form>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right visible-sm visible-md visible-xs hidden-lg">                    
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal4">Login</a></li>
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
                </ul>
                <!--          <ul class="nav navbar-nav navbar-right right-margin">
                                <li class="active"><a href="<?php echo Yii::app()->request->baseUrl . '/site/index'; ?>" style="padding-top: 12px; padding-bottom: 12px;"><span class="icon-login"></span>Login</a></li>
                                <li class="separator" style="height: 50px;"></li>
                                <li class="active"><a href="<?php echo Yii::app()->request->baseUrl . '/site/index'; ?>" style="padding-top: 12px; padding-bottom: 12px;"><span class="icon-signup"></span>Sign Up</a></li>
                            </ul>-->
            <?php } ?>

        </div>
    </div>
</nav>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(250,250, 250, 0.5);top:0%;">

    <div class="modal-dialog" style="top:30%;width: 40%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #F1f1f1;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">LOGIN</h4>
            </div>
            <div class="modal-body" >
                <form class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl . '/site/login'; ?>" method="post"><!--start form--><!--add form action as needed-->
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" id="login-user" class="form-control" name="LoginForm[username]" placeholder="USERNAME">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group space">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" id="login-pwd" class="form-control" name="LoginForm[password]"  placeholder="PASSWORD">
                                </div>
                            </div>
                            <?php if (Yii::app()->user->hasFlash('loginfailed')) { ?>
                                <div class="col-sm-12">
                                    <div class="input-group space">
                                        <span style="color:#FFFFFF;font-weight: bold;"><?php echo Yii::app()->user->getFlash('loginfailed'); ?></span>                    
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-12">
                                <div class="input-group space login-btn">
                                    <button type="submit" class="btn btn-default">Login</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group space">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" style="color:green;">Sign Up</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group space login-btn">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1" style="color:green;">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                </form>
            </div>
            <div class="modal-footer" style="background: #F1f1f1;">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" style="background-color: rgba(250,250, 250, 0.5);top:0%;">
    
    <div class="modal-dialog" style="top:10%;width: 40%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #136b9b;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #FFF;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#FFF">LOGIN</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 0px; padding-top: 0px;">
                        <div class="col-sm-12">                           
                            <div class="account-wall">
                                <img class="profile-img" src="<?php echo Yii::app()->request->baseUrl . '/uploads/profilePic/user.jpg'; ?>"  alt="">
                                <form class="form-signin" action="<?php echo Yii::app()->request->baseUrl . '/site/login'; ?>" method="post">
                                    <input type="text" class="form-control" placeholder="Username" name="LoginForm[username]" required autofocus>
                                    <input type="password" class="form-control" placeholder="Password" name="LoginForm[password]"  required>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                                        Sign in</button>
                                    <label class="checkbox pull-left" style="padding-left: 15px;">
                                        <input type="checkbox" value="remember-me">
                                        Remember me
                                    </label>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1" class="pull-right need-help">Forgot Password? </a><span class="clearfix"></span>
                                </form>
                            </div>                            
                        </div> 
            </div>
            <div class="modal-footer" style="background: #F1f1f1;">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top:10%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #f1f1f1;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">SIGN UP</h4>
            </div>
            <div class="modal-body">
                <div class="well">
                    <ul class="nav nav-tabs">
                        <li id="boot-tab-1"><a href="javascript:void(0);" class="btn btn-default" id="btnstep1" >Step1</a></li>
                        <li id="boot-tab-2"><a href="javascript:void(0);" class="btn btn-primary" id="btnstep2" >Step2</a></li>
                        <li id="boot-tab-3"><a href="javascript:void(0);" class="btn btn-primary" id="btnstep3" >Step3</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="step1">
                            <!--form class="form-horizontal" action='' method="POST"-->
                            <div id="tab-step-1" class="container-fluid">
                                <div class="form-group">
                                    <br/>
                                    <select id="state" class="form-control" value="" name="state" required required>
                                        <option value="00">Select State</option>
                                        <?php
                                        $stateList = State::model()->findAll();
                                        if (isset($stateList) && !empty($stateList)) {
                                            foreach ($stateList as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value['state_code'] ?>"><?php echo $value['state_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="radio" id="choice" name="choice" value="Mobile" onclick="handleClick(this.value);" style="margin-right: 5px;">Mobile
                                    <input type="radio" id="choice" name="choice" value="Aadhar" onclick="handleClick(this.value);" style="margin-right: 5px;">Aadhar
                                </div>
                                <div class="form-group" style="display:none;" id="divmobile">
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" onkeyup="phoneAvail(this.value)" required pattern="[789][0-9]{9}" title="[[7/8/9]XXXXXXXXX]">
                                </div>
                                <div class="form-group" style="display:none;" id="divaadhar">
                                    <input type="text" class="form-control" id="aadhar" placeholder="Aadhaar Number" onkeyup="aadharAvail(this.value)" required pattern="[0-9]{12}" title="[[XXXXXXXXXXXX]">
                                </div>
                                <div class="row" style="display:none;" id="mobilevalid">                                    
                                    <div class="col-xs-9"><span id="mobile-valid"/> </div>
                                </div>
                                <div class="row" style="display:none;">                                    
                                    <div class="col-xs-6"><span id="mobilevalue"/> </div>
                                    <div class="col-xs-6"><span id="aadharvalue"/> </div>
                                    <div class="col-xs-6"><span id="statevalue"/> </div>
                                    <div class="col-xs-6"><span id="selectoption"/> </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default pull-right" onclick="RegStep1()">Submit</button>

                                </div>
                                <br>
                                <div class="form-group">
                                    <span id="OTPResponse"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div id="Signup-Message" class="alert alert-danger bs-alert-old-docs">
                                        <strong>"If you have not registered with the MGNREGA staff portal,</strong> 
                                        <a href="http://nrega.nic.in/netnrega/home.aspx">click here"</a>
                                    </div>
                                </div>
                            </div>
                            <!--/form-->                
                        </div>

                        <!--div class="tab-pane fade" id="step2"-->
                        <!--form id="tab" class="form-horizontal"-->
                        <div id="tab-step-2" class="container-fluid" style="display:none">
                            <div class="form-group">
                                <br/>
                                <label for="exampleInputFile">Enter NETSECURE<sup>TM</sup>(OTP) Code</label>
                                <input type="text" id="otpNumber"><button type="submit" class="btn btn-default pull-right" onclick="RegStep2()" id="otpsumbit">Submit</button>
                            </div>
                            <div class="form-group">
                                <div style="display:none;" id="otp-status">
                                    <span id="otpstatus"></span>
                                </div>
                            </div>					
                            <div class="form-group">
                                <button type="button" class="btn btn-default pull-right" onclick="resendOTP()">Resend OTP</button>                                
                            </div>
                        </div>
                        <!--/form-->
                        <!--/div-->
                        <!--div class="tab-pane fade" id="step3"-->
                        <!--form id="tab" class="form-horizontal"-->
                        <div id="tab-step-3" class="container-fluid" style="display:none">
                            <br/>
                            <div class="col-xs-6" >
                                <div class="form-group">    
                                    <span>Name : </span>
                                    <input class="form-control" type="text" id="signup_staff_name" placeholder="Staff Name" readonly>
                                </div>
                                <div class="form-group">
                                    <span>Mobile Number : </span>
                                    <input class="form-control" type="text" id="signup_mobile" placeholder="Mobile Number" readonly>
                                </div>
                                <div class="form-group"> 
                                    <span>Aadhaar Number : </span>
                                    <input class="form-control" type="text" id="signup_aadhar" placeholder="Adhaar" readonly>
                                </div>
                                <div class="form-group">
                                    <span>Email : </span>
                                    <input class="form-control" type="text" id="signup_email" placeholder="Email ID" readonly>
                                </div>
                                <div class="form-group">  
                                    <span>Designation : </span>
                                    <input class="form-control" type="text" id="signup_functionary_name" placeholder="Functionary Name" readonly>
                                </div>
                            </div>
                            <div class="col-xs-6" >
                                <div class="form-group">
                                    Create your User ID
                                    <input class="form-control" type="text" id="signup_username" onkeyup="checkUserNameAvail(this.value)" placeholder="Create your User ID" required>
                                    <lable id="messageusername"></lable>
                                </div>
                                <div class="form-group">
                                    Password
                                    <input class="form-control" type="password" id="password" placeholder="Please Enter Password" required>
                                </div>
                                <div class="form-group">
                                    Re-Type Password
                                    <input class="form-control" type="password" id="passwordConfirm" placeholder="Please Re-Type Password" required>
                                    <lable id="message"></lable>
                                </div>
                                <div class="form-group">
                                    <div id="signup-status" style="display: none;">
                                        <span id="signupstatus"></span>
                                    </div>
                                </div>
                            </div>                      
                            <br>
                            <div class="form-group">
                                <button type="submit" id="submitBttnFinish" class="btn btn-default pull-right" onclick="RegStep3()" style="display:none;margin-left: 5px">Confirm</button>
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="step3cancel">Cancel</button>
                                <a href="<?php echo Yii::app()->request->baseUrl . '/site'; ?>" style="display:none;" id="step3login"><button type="button" class="btn btn-default pull-right">Login</button></a>
                            </div><br>


                        </div>
                        <!--/form-->
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #f1f1f1;">


                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;color:red;">
                    <span aria-hidden="true">x</span>
                </button>
                <h3 class="text-center">Forgot Password?</h3>

            </div>
            <br/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">
                                    <p>If you have forgotten your password - reset it here.</p>
                                    <div class="panel-body">

                                        <form class="form"><!--start form--><!--add form action as needed-->
                                            <fieldset>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                        <!--EMAIL ADDRESS-->
                                                        <input id="emailforgot" placeholder="Email address" class="form-control" type="email" onkeyup="emailAvail(this.value)" required="">
                                                    </div>
                                                </div>
                                                <div class="row" style="display:none;" id="emailvalid">                                                    
                                                    <div class="col-xs-12"><span id="email-valid"/> </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-default pull-right"  type="button" onclick="forgotpassword()">Reset Password</button>
                                                </div>
                                            </fieldset>
                                            <br/>
                                            <div class="row" style="display:none;" id="forgotvalid">                                                    
                                                <div class="col-xs-12"><span id="forgot-valid"/> </div>
                                            </div>                                            
                                        </form><!--/end form-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#passwordConfirm').on('keyup', function () {         
        if ($(this).val() == $('#password').val()) {
            $('#message').html('Passwords are matching').css('color', 'green');
            var name=document.getElementById('signup_username').value;
            if(name.length >= 6){
                document.getElementById("submitBttnFinish").style.display='';
            }
               
        } else {
            $('#message').html('Passwords are not matching' ).css('color', 'red');
            document.getElementById("submitBttnFinish").style.display='none';
        }
    });
    $('#password').on('keyup', function () {         
        if ($(this).val() == $('#passwordConfirm').val()) {
            $('#message').html('Passwords are matching').css('color', 'green');
            var name=document.getElementById('signup_username').value;
            if(name.length >= 6){
                document.getElementById("submitBttnFinish").style.display='';
            }
               
        } else {
            $('#message').html('Passwords are not matching' ).css('color', 'red');
            document.getElementById("submitBttnFinish").style.display='none';
        }
    });
        
    function checkUserNameAvail(userName){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        if (userName.length >= 6) {
            jQuery.ajax({                            
                url: baseurl+'/nicdata/checkUsernameAvail',
                type: "POST",
                data: { userName: userName
                    
                },  
                error: function(){
                    document.getElementById("mobilevalid").style.display = '';
                    $('#messageusername').html('User Name is not available to register in OLP').css('color', 'red');
                },
                success: function(resp){    
                    
                    if(resp=="registered"){
                        document.getElementById("submitBttnFinish").style.display='none';
                        if((document.getElementById('password').value==document.getElementById('passwordConfirm').value) &&(document.getElementById('password').length != 0)){
                            document.getElementById("submitBttnFinish").style.display='none';
                        }                    
                        document.getElementById("signup-status").style.display = '';
                        $('#messageusername').html('User Name is not available to register in OLP').css('color', 'red');                   
                    }else{
                        document.getElementById("submitBttnFinish").style.display='';
                        document.getElementById("signup-status").style.display = '';
                        $('#messageusername').html('User name is available to register in OLP').css('color', 'green'); 
                    
                    }                                  
                  
                }
            });
        }else{
            $('#messageusername').html('Please... Enter Username of minimum 6 Chareacters' ).css('color', 'red');
        }
            
    }
        
        
</script>
<script type="text/javascript">
    var userdata;
    function viewForgotPassword()
    {
        document.getElementById("login-viewform").style.display='none';
          
    }   
    function displaylogin()
    {
        document.getElementById("login-viewform").style.display='block';
    }
    function cancelReg(){
        window.location("http://nrega.nic.in/netnrega/home.aspx",'_blank')
    }
    function step1(){  
        $('#btnstep1').removeClass('btn-primary');
        $('#btnstep1').addClass('btn-default');
        $('#btnstep2').removeClass('btn-default');
        $('#btnstep2').addClass('btn-primary');
        $('#btnstep3').removeClass('btn-default');
        $('#btnstep3').addClass('btn-primary');
                  
        document.getElementById("tab-step-1").style.display='block';
        document.getElementById("tab-step-2").style.display='none';  
        document.getElementById("tab-step-3").style.display='none';
    }
    function step2(){   
        $('#btnstep2').removeClass('btn-primary');
        $('#btnstep2').addClass('btn-default');
        $('#btnstep1').removeClass('btn-default');
        $('#btnstep1').addClass('btn-primary');
        $('#btnstep3').removeClass('btn-default');
        $('#btnstep3').addClass('btn-primary');
                  
        document.getElementById("tab-step-1").style.display='none';
        document.getElementById("tab-step-2").style.display='block';  
        document.getElementById("tab-step-3").style.display='none';
    }
    function step3(){ 
        $('#btnstep3').removeClass('btn-primary');
        $('#btnstep3').addClass('btn-default');
        $('#btnstep1').removeClass('btn-default');
        $('#btnstep1').addClass('btn-primary');
        $('#btnstep2').removeClass('btn-default');
        $('#btnstep2').addClass('btn-primary');
                 
        document.getElementById("tab-step-1").style.display='none';
        document.getElementById("tab-step-2").style.display='none';  
        document.getElementById("tab-step-3").style.display='block';
    }
    function RegStep1(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        var state=document.getElementById("state").value;
        var selectoption = document.getElementById("selectoption").value;
        var mobile='';var aadhar='';
        if(selectoption=="Mobile"){
            mobile=document.getElementById("mobile").value;
        }else{
            aadhar=document.getElementById("aadhar").value;
        }
        
        if(selectoption=="Mobile"){            
            jQuery.ajax({                            
                url: baseurl+'/nicdata/VerifyMobileService',
                type: "POST",
                data: { mobile_no: mobile,
                    state_code : state                   
                },  
                error: function(){
                    document.getElementById("mobilevalid").style.display = '';
                    $('#mobile-valid').html('Please enter Valid Details check availability for Registration').css('color', 'red');
                },
                success: function(resp){    
                                        
                    document.getElementById("statevalue").value=state;
                    document.getElementById("mobilevalue").value=mobile;
                    if(resp=='alreadyRegistered'){
                        document.getElementById("mobilevalid").style.display = '';
                        $('#mobile-valid').html('<?php echo Yii::app()->params['userAlreadyRegistered']; ?>').css('color', 'red');
                    }else{
                        var json = JSON.parse(resp); 
                                            
                        if(json.Error_Code !=""){
                            document.getElementById("mobilevalid").style.display = '';                          
                            
                            $('#mobile-valid').html(json.Error_Message).css('color', 'red');
                            
                            
                        }else{                         
                            userdata=json.Response_Data;
                            $('#btnstep2').removeClass('btn-primary');
                            $('#btnstep2').addClass('btn-default');
                            $('#btnstep1').removeClass('btn-default');
                            $('#btnstep1').addClass('btn-primary');
                            $('#btnstep3').removeClass('btn-default');
                            $('#btnstep3').addClass('btn-primary');
                            document.getElementById("tab-step-1").style.display='none';
                            document.getElementById("tab-step-2").style.display='block';  
                            document.getElementById("tab-step-3").style.display='none';      
                        }  
                    }
                    document.getElementById("otp-status").style.display = '';
                 $('#otpstatus').html('A One Time Password (OTP) is sent to your mobile number and mail id' ).css('color', 'green');                    
                                        
                }
            });
        }else{
            jQuery.ajax({                            
                url: baseurl+'/nicdata/VerifyAadhaarService',
                type: "POST",
                data: {
                    state_code : state,
                    aadhaar_no :aadhar
                    
                },  
                error: function(){
                    document.getElementById("mobilevalid").style.display = '';
                    $('#mobile-valid').html('Please enter Valid Details check availability for Registration').css('color', 'red');
                },
                success: function(resp){
                    
                    
                    document.getElementById("statevalue").value=state;                                      
                    if(resp=='alreadyRegistered'){
                        document.getElementById("mobilevalid").style.display = '';
                        $('#mobile-valid').html('<?php echo Yii::app()->params['userAlreadyRegistered']; ?>').css('color', 'red');
                    }else{
                        var json = JSON.parse(resp); 
                                            
                        if(json.Error_Code !=""){
                            document.getElementById("mobilevalid").style.display = '';
                           $('#mobile-valid').html(json.Error_Message).css('color', 'red');
                        }else{                         
                            userdata=json.Response_Data;
                            $('#btnstep2').removeClass('btn-primary');
                            $('#btnstep2').addClass('btn-default');
                            $('#btnstep1').removeClass('btn-default');
                            $('#btnstep1').addClass('btn-primary');
                            $('#btnstep3').removeClass('btn-default');
                            $('#btnstep3').addClass('btn-primary');
                            document.getElementById("tab-step-1").style.display='none';
                            document.getElementById("tab-step-2").style.display='block';  
                            document.getElementById("tab-step-3").style.display='none';      
                        }  
                    }  
                     document.getElementById("otp-status").style.display = '';
                 $('#otpstatus').html('A One Time Password (OTP) is sent to your mobile number and mail id' ).css('color', 'green');
                }
            });
        }
    }
    
    function RegStep2(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        var state=document.getElementById("statevalue").value;
        var mobile=document.getElementById("mobilevalue").value;
        var otp=document.getElementById("otpNumber").value;
        jQuery.ajax({                            
            url: baseurl+'/Nicdata/getDataAvail',
            type: "POST",
            data: {mobile: mobile,
                state : state,
                otp   : otp
            },  
            error: function(){
                document.getElementById("otp-status").style.display = '';
                $('#otpstatus').html('Please enter Valid Details check availability' ).css('color', 'red');
            },
            success: function(resp){
                   
                if(resp=="otpsuccess"){
                    $('#btnstep3').removeClass('btn-primary');
                    $('#btnstep3').addClass('btn-default');
                    $('#btnstep1').removeClass('btn-default');
                    $('#btnstep1').addClass('btn-primary');
                    $('#btnstep2').removeClass('btn-default');
                    $('#btnstep2').addClass('btn-primary');

                    document.getElementById("tab-step-1").style.display='none';
                    document.getElementById("tab-step-2").style.display='none';  
                    document.getElementById("tab-step-3").style.display='block';                       
                    
                    document.getElementById("signup_email").value=userdata.Email_id;
                    document.getElementById("signup_mobile").value=userdata.Mobile_no;
                    document.getElementById("signup_aadhar").value=userdata.Aadhaar_no1;
                    document.getElementById("signup_functionary_name").value=userdata.Functionary_name;
                    document.getElementById("signup_staff_name").value=userdata.Staff_name;
                    
                    
                }else if(resp=="otpfail"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('Please provide a valid OTP').css('color', 'red'); 
                     $('#otpsubmit').addClass('btn-primary');
                }
                    
            }
        });
       
    }
    function RegStep3(){
       document.getElementById("step3cancel").style.display='none';
        document.getElementById("submitBttnFinish").style.display='none';
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        var username = document.getElementById("signup_username").value;
        var password = document.getElementById("password").value;
        var email = userdata.Email_id;
        var staffid = userdata.Staff_id;
        var designation = userdata.Designation_code; 
        var state=document.getElementById("statevalue").value;
        var mobile=userdata.Mobile_no;
        var adhaar=userdata.Aadhaar_no1;
        var firstname = userdata.Functionary_name;
        var staffname = userdata.Staff_name;
       
        
        jQuery.ajax({                            
            url: baseurl+'/site/register',
            type: "POST",
            data: {
                username :username,
                password :password,
                email :email,
                staffid : staffid,
                designation : designation,
                state : state,
                mobile : mobile,
                adhaar : adhaar,
                firstname : firstname,
                staffname : staffname
                   
            },  
            error: function(){
                document.getElementById("otp-status").style.display = '';
                $('#otpstatus').html('Please enter Valid Details check availability' ).css('color', 'red');
            },
            success: function(resp){
                   
                if(resp=="registered"){
                    document.getElementById("signup-status").style.display = '';
                    $('#signupstatus').html('You have successfully registered in OLP.Please check your mobile number or email id for user name and password, to login to OLP').css('color', 'green');                   
                    document.getElementById("step3cancel").style.display = 'none';
                    document.getElementById("step3login").style.display = '';
            }else{
                    document.getElementById("signup-status").style.display = '';
                    $('#signupstatus').html('Something went wrong .please try later').css('color', 'red'); 
                }                    
            }
        });
    
    
    
    }
    function resendOTP(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        var mobile = document.getElementById("mobilevalue").value;
        var email = userdata.email;
        jQuery.ajax({                            
            url: baseurl+'/Nicdata/resendOtp',
            type: "POST",
            data: {mobile: mobile,
                email :userdata.Email_id
            },  
            error: function(){
                document.getElementById("otp-status").style.display = '';
                $('#otpstatus').html('Please enter Valid Details to send OTP' ).css('color', 'red');
            },
            success: function(resp){
                    
                if(resp=="sent"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('OTP sent successfully to '+mobile).css('color', 'green');
                }else if(resp=="fail"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('something went wrong while sending OTP...Please try later.').css('color', 'red');
                }else if(resp=="mailfail"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('New OTP resent successfully to '+mobile).css('color', 'green');
                }
                    
            }
        });
    }
    function phoneAvail(mobile)
    {                  
       
        if (mobile.length == 10) {
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('You have entered Valid mobile number' ).css('color', 'green');
        } else{
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Please enter 10 digit mobile number to register...' ).css('color', 'red');
        }
        
    }
    function aadharAvail(aadhar)
    {                  
       
        if (aadhar.length == 12) {
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('You have Entered  Valid Aadhaar number' ).css('color', 'green');
        } else{
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Please enter 12 digit aadhar number to register...' ).css('color', 'red');
        }
        
    }
</script>
<script type="text/javascript">        
    function emailAvail(email)
    {    
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";      
        if(email != null && checkEmail(email)){
            jQuery.ajax({                            
                url: baseurl+'/site/checkemail',
                type: "POST",
                data: {email: email},  
                error: function(){
                    document.getElementById("emailvalid").style.display = '';
                    $('#email-valid').html('Please enter email to send reset password link' ).css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("emailvalid").style.display = '';
                    if(resp=="registered"){
                        $('#email-valid').html('Congrats...! this email is registered with us click send button to get reset password link.' ).css('color', 'green');
                    }else if(resp=="notregistered"){
                        $('#email-valid').html('Oops..! this email is not registered with us to send reset password link').css('color', 'red');
                    }else if(resp=="notset"){
                        $('#email-valid').html('Please enter email to send reset password link' ).css('color', 'red');
                    }                                        
                }
            });
        } else{
            document.getElementById("emailvalid").style.display = '';
            $('#email-valid').html('Please enter valid email to send reset password link...' ).css('color', 'red');
        }
    }
    function forgotpassword()
    {    
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var email = document.getElementById("emailforgot").value;
        if(email != null && checkEmail(email)){
            jQuery.ajax({                            
                url: baseurl+'/site/ForgotPassword',
                type: "POST",
                data: {email: email},  
                error: function(){
                    document.getElementById("forgotvalid").style.display = '';
                    $('#forgot-valid').html('Please enter valid email to Reset Password').css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("forgotvalid").style.display = '';
                    if(resp=="sent"){
                        $('#forgot-valid').html('Reset Password link successfully sent to your mail.' ).css('color', 'green');
                    }else if(resp=="fail"){
                        $('#forgot-valid').html('Oops..! something went wrong while sending mail.please try later.').css('color', 'red');
                    }else if(resp=="notset"){
                        $('#forgot-valid').html('Please enter valid email to Reset Password' ).css('color', 'red');
                    }                                        
                }
            });
        } else{
            document.getElementById("emailvalid").style.display = '';
            $('#email-valid').html('Please enter valid email to Reset Password' ).css('color', 'red');
        }
    }
    function checkEmail(inputvalue){	
        var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        if(pattern.test(inputvalue)){         
            return true;  
        }else{   
            return false;
        }
    }
    function handleClick(value){      
        if(value=="Mobile"){
            document.getElementById("divaadhar").style.display='none';
            document.getElementById("divmobile").style.display='';
            document.getElementById("aadhar").value='';
            $('#mobile-valid').html('').css('color', 'green');
            document.getElementById("selectoption").value=value;            
        }else{
            document.getElementById("divmobile").style.display='none';
            document.getElementById("divaadhar").style.display='';
            document.getElementById("mobile").value='';
            $('#mobile-valid').html('').css('color', 'green');
            document.getElementById("selectoption").value=value;            
        }
        
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        document.getElementById("tab-step-1").style.display='block';
        document.getElementById("tab-step-2").style.display='none';  
        document.getElementById("tab-step-3").style.display='none';
    });
</script>