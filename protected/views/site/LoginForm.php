<div class="container">
    <br>
    <div id="course-container" class="col-xs-12">
        <div class="col-xs-4"></div> 

        <div class="col-xs-5">             
            <?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-danger fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-success fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
           
            <form action="<?php echo Yii::app()->request->baseUrl . '/site/loginForm'; ?>" method="POST"  enctype="multipart/form-data">               
                <div class="row">
                    <h4 id="courseDetailHeading"><B>User Login</B></h4><hr/>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        User Name
                    </div>
                    <div class="col-xs-8">
                        <input type="text" id="login-user" class="form-control" name="LoginForm[username]" placeholder="USERNAME">
                    </div>
                </div>  
                <br>
                <div class="row">
                    <div class="col-xs-4">
                        Password
                    </div>
                    <div class="col-xs-8">
                        <input type="password" id="login-pwd" class="form-control" name="LoginForm[password]"  placeholder="PASSWORD">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-4">
                        <input type="submit" id="CourseDetailsBttn" class="btn btn-default pull-right" value="Submit"/>
                    </div>
                </div>
                <div>
                    <div class="col-xs-2">

                    </div>
                    <div class="col-xs-10" style="padding-right: 0px;">
                        <div class="col-sm-4">
                            <div class="input-group space">
                                <a href="javascript:void(0);" style="color:green;" data-toggle="modal" data-target="#myModal">Sign Up</a>
                            </div>
                        </div>
                        <div class="col-sm-8" style="padding-right: 0px;">
                            <div class="input-group space login-btn">
                                <a href="javascript:void(0);" style="color:green;" data-toggle="modal" data-target="#myModal1">Forgot Password?</a>
                            </div>
                        </div>
                    </div>

                </div>

            </form>  


        </div>
        <div class="col-xs-3"></div> 
    </div>
    <br>

</div>

<?php $this->renderPartial('//layouts/footer_main'); ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                                        <option value="">Select State</option>
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
                                <input type="text" id="otpNumber"><button type="submit" class="btn btn-default pull-right" onclick="resendOTP()">Resend OTP</button></div>
                            <div class="form-group">
                                <div style="display:none;" id="otp-status">
                                    <span id="otpstatus"></span>
                                </div>
                            </div>					
                            <div class="form-group">
                                <button type="submit" class="btn btn-default pull-right" onclick="RegStep2()">Submit</button>
                            </div>
                        </div>
                        <!--/form-->
                        <!--/div-->
                        <!--div class="tab-pane fade" id="step3"-->
                        <!--form id="tab" class="form-horizontal"-->
                        <div id="tab-step-3" class="container-fluid" style="display:none">
                            <div class="form-group">
                                <br/>
                                <input class="form-control" type="text" id="signup_username" placeholder="User Name" readonly>
                            </div>
                            <!--                            <div class="form-group">
                            
                                                            <input class="form-control" type="text" id="signup_firstName" placeholder="First Name" readonly>
                                                        </div>-->
                            <!--                            <div class="form-group">
                            
                                                            <input class="form-control" type="text" id="signup_lastName" placeholder="Last Name" readonly>
                                                        </div>	-->
                            <div class="form-group">
                                <input class="form-control" type="text" id="signup_staffId" placeholder="Staff ID" readonly>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="signup_designation" placeholder="Designation" readonly>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="signup_email" placeholder="Email ID" readonly>
                            </div>
                            <div class="form-group">
                                <div id="signup-status" style="display: none;">
                                    <span id="signupstatus"></span>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <button type="submit" id="submitBttnFinish" class="btn btn-default pull-right" onclick="RegStep3()">Confirm</button>
                            </div><br>
                            <div class="form-group">
                                <button type="button"  class="btn btn-default pull-right" onclick="cancel()">Cancel</button>
                            </div>

                        </div>
                        <!--/form-->
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    function viewForgotPassword()
    {
        document.getElementById("login-viewform").style.display='none';
          
    }   
    function displaylogin()
    {
        document.getElementById("login-viewform").style.display='block';
    }
    function cancel(){
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
            url: 'http://10.21.35.239/nrega_rest_svc/nrega_nird_olp.svc/VerifyMobile',
            type: "POST",
            data: {mobile_no: mobile,
                    state_code : state                   
            },  
            error: function(){
                document.getElementById("mobile-valid").style.display = '';
                $('#mobilevalid').html('Please enter Valid Details check availability' ).css('color', 'red');
            },
            success: function(resp){
                    alert(resp);
//                if(resp=="registered"){
//                    document.getElementById("mobilevalue").value=mobile;
//                    document.getElementById("statevalue").value=state;
//                    $('#btnstep2').removeClass('btn-primary');
//                    $('#btnstep2').addClass('btn-default');
//                    $('#btnstep1').removeClass('btn-default');
//                    $('#btnstep1').addClass('btn-primary');
//                    $('#btnstep3').removeClass('btn-default');
//                    $('#btnstep3').addClass('btn-primary');
//                    document.getElementById("tab-step-1").style.display='none';
//                    document.getElementById("tab-step-2").style.display='block';  
//                    document.getElementById("tab-step-3").style.display='none';                           
//                            
//                }else if(resp=="notregistered"){
//                    document.getElementById("mobilevalid").style.display = '';
//                    $('#mobile-valid').html('Please enter Valid Details check availability').css('color', 'red');
//                }
                    
            }
        });
        }else{
            jQuery.ajax({                            
            url: 'http://10.21.35.239/nrega_rest_svc/nrega_nird_olp.svc/VerifyAadhaar',
            type: "POST",
            data: {
                    state_code : state,
                    aadhaar_no :aadhar
                    
            },  
            error: function(){
                document.getElementById("mobile-valid").style.display = '';
                $('#mobilevalid').html('Please enter Valid Details check availability' ).css('color', 'red');
            },
            success: function(resp){
                    alert(resp);
//                if(resp=="registered"){
//                    document.getElementById("mobilevalue").value=mobile;
//                    document.getElementById("statevalue").value=state;
//                    $('#btnstep2').removeClass('btn-primary');
//                    $('#btnstep2').addClass('btn-default');
//                    $('#btnstep1').removeClass('btn-default');
//                    $('#btnstep1').addClass('btn-primary');
//                    $('#btnstep3').removeClass('btn-default');
//                    $('#btnstep3').addClass('btn-primary');
//                    document.getElementById("tab-step-1").style.display='none';
//                    document.getElementById("tab-step-2").style.display='block';  
//                    document.getElementById("tab-step-3").style.display='none';                           
//                            
//                }else if(resp=="notregistered"){
//                    document.getElementById("mobilevalid").style.display = '';
//                    $('#mobile-valid').html('Please enter Valid Details check availability').css('color', 'red');
//                }
                    
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
                   
                if(resp=="notregistered"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('Please enter Valid Details check availability').css('color', 'red');                   
                }else if(resp=="otpfail"){
                    document.getElementById("otp-status").style.display = '';
                    $('#otpstatus').html('Please Provide Valid OTP').css('color', 'red'); 
                }else{
                       
                    var json = JSON.parse(resp);    
                    $('#btnstep3').removeClass('btn-primary');
                    $('#btnstep3').addClass('btn-default');
                    $('#btnstep1').removeClass('btn-default');
                    $('#btnstep1').addClass('btn-primary');
                    $('#btnstep2').removeClass('btn-default');
                    $('#btnstep2').addClass('btn-primary');

                    document.getElementById("tab-step-1").style.display='none';
                    document.getElementById("tab-step-2").style.display='none';  
                    document.getElementById("tab-step-3").style.display='block';
                        
                    document.getElementById("signup_username").value=json.email;
                    document.getElementById("signup_staffId").value='122';
                    document.getElementById("signup_designation").value='designation';
                    document.getElementById("signup_email").value=json.email;                         
                        
                }
                    
            }
        });
       
    }
    function RegStep3(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        var email = document.getElementById("signup_email").value;
        var staffid = document.getElementById("signup_staffId").value;
        var designation = document.getElementById("signup_designation").value; 
        var state=document.getElementById("statevalue").value;
        var mobile=document.getElementById("mobilevalue").value;
        jQuery.ajax({                            
            url: baseurl+'/site/register',
            type: "POST",
            data: {email: email,
                staffid : staffid,
                designation : designation,
                state : state,
                mobile : mobile
            },  
            error: function(){
                document.getElementById("otp-status").style.display = '';
                $('#otpstatus').html('Please enter Valid Details check availability' ).css('color', 'red');
            },
            success: function(resp){
                   
                if(resp=="registered"){
                    document.getElementById("signup-status").style.display = '';
                    $('#signupstatus').html('You are successfully Registered with us.Login Details are sent to your mail').css('color', 'green');                   
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
        jQuery.ajax({                            
            url: baseurl+'/Nicdata/resendOtp',
            type: "POST",
            data: {mobile: mobile                       
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
                }
                    
            }
        });
    }
    function phoneAvail(mobile)
    {                  
       
        if (mobile.length == 10) {
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Your Number is Available to Register' ).css('color', 'green');
        } else{
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Please enter 10 didgit mobile number to register...' ).css('color', 'red');
        }
        
    }
    function aadharAvail(aadhar)
    {                  
       
        if (aadhar.length == 12) {
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Your Number is Available to Register' ).css('color', 'green');
        } else{
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Please enter 12 didgit aadhar number to register...' ).css('color', 'red');
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
                    $('#email-valid').html('Please enter email to check availability' ).css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("emailvalid").style.display = '';
                    if(resp=="registered"){
                        $('#email-valid').html('Congrats...! this email is registered with us.' ).css('color', 'green');
                    }else if(resp=="notregistered"){
                        $('#email-valid').html('Oops..! this email is not registered with us').css('color', 'red');
                    }else if(resp=="notset"){
                        $('#email-valid').html('Please enter email to check availability' ).css('color', 'red');
                    }                                        
                }
            });
        } else{
            document.getElementById("emailvalid").style.display = '';
            $('#email-valid').html('Please enter valid email to register...' ).css('color', 'red');
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
