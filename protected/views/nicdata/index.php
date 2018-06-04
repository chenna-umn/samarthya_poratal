
<div class="container" style="background: #FFFFFF;">
    <form action="<?php echo Yii::app()->request->baseUrl . '/Nicdata/index'; ?>" method="POST">
        <input type="hidden" name="action" value="AddUser"/>
        <h3 align="center">Add a User to Portal</h3><hr/>

        <div class="row">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <?php if (Yii::app()->user->hasFlash('error')) { ?>
                    <div class="row margin-bottom-10">
                        <div class="info1 alert alert-success fade in">
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (Yii::app()->user->hasFlash('success')) { ?>
                    <div class="row margin-bottom-10">
                        <div class="info1 alert alert-success fade in">
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div><br>        
        <div class="row">
            <div align="right" class="col-xs-4">Firstname : </div>
            <div class="col-xs-4"><input type="text"  name="Nicdata[firstname]" required class="form-control"/> </div>
        </div><br>

        <div class="row">
            <div align="right" class="col-xs-4">Lastname : </div>
            <div class="col-xs-4"><input type="text"  name="Nicdata[lastname]" required class="form-control"/> </div>
        </div><br>

        <div class="row">
            <div align="right" class="col-xs-4">Staff Id : </div>
            <div class="col-xs-4"><input type="text" name="Nicdata[staffid]" required class="form-control"/> </div>
        </div><br>

        <div class="row">
            <div align="right" class="col-xs-4">Designation : </div>
            <div class="col-xs-4"><input type="text" name="Nicdata[designation]" required class="form-control"/> </div>
        </div><br>

        <div class="row">
            <div align="right" class="col-xs-4">Email Id : </div>
            <div class="col-xs-4"><input type="email" name="Nicdata[email]" id="addUser-email_Id" onkeyup="emailAvail(this.value)" class="form-control"/> </div>
        </div><br>
        <div class="row" style="display:none;" id="emailvalid">
            <div align="right" class="col-xs-4"></div>
            <div class="col-xs-4"><span id="email-valid"/> </div>
        </div>
        <div class="row">
            <div align="right" class="col-xs-4">Phone Number : </div>
            <div class="col-xs-4"><input type="text" name="Nicdata[mobile]" id="addUser-phoneNumber" onkeyup="phoneAvail(this.value)" required pattern="[789][0-9]{9}" title="[[7/8/9]XXXXXXXXX]" class="form-control"/> </div>
        </div><br>
        <div class="row" style="display:none;" id="mobilevalid">
            <div align="right" class="col-xs-4"></div>
            <div class="col-xs-4"><span id="mobile-valid"/> </div>
        </div>

        <div class="row">
            <div align="right" class="col-xs-4">State : </div>
            <div class="col-xs-4"><select  class="form-control" value="" name="Nicdata[state_code]" required>
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
                </select> </div>
        </div><br>
        <div class="row">
            <div align="right" class="col-xs-4">Aadhaar Number : </div>
            <div class="col-xs-4"><input type="text" name="Nicdata[aadhaar_no]" id="addUser-phoneNumber" onkeyup="aadharAvail(this.value)" required pattern="[0-9]{12}" title="[XXXXXXXXXXXX]" class="form-control"/> </div>
        </div>
        <div class="row" style="display:none;" id="aadharvalid">
            <div align="right" class="col-xs-4"></div>
            <div class="col-xs-4"><span id="aadhar-valid"/> </div>
        </div>
        <br>
        
        <div class="row">
            <div class="col-xs-8">
                <input type="submit"  id="submitButton" class="btn btn-primary pull-right" value=" Submit "/>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript">        
    function emailAvail(email)
    {    
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";      
        if(email != null && checkEmail(email)){
            jQuery.ajax({                            
                url: baseurl+'/Nicdata/checkemail',
                type: "POST",
                data: {email: email},  
                error: function(){
                    document.getElementById("emailvalid").style.display = '';
                    $('#email-valid').html('Please enter email to check availability' ).css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("emailvalid").style.display = '';
                    if(resp=="registered"){
                        $('#email-valid').html('This email is already registerd with us..please try with another email address.' ).css('color', 'red');
                    }else if(resp=="notregistered"){
                        $('#email-valid').html('Congrats...! this email is available to register').css('color', 'green');
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
    function phoneAvail(mobile)
    {                  
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        if (mobile.length == 10) { 
            jQuery.ajax({                            
                url: baseurl+'/Nicdata/checkmobile',
                type: "POST",
                data: {mobile: mobile},  
                error: function(){
                    document.getElementById("mobilevalid").style.display = '';
                    $('#mobile-valid').html('Please enter mobile number email to check availability' ).css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("mobilevalid").style.display = '';
                    if(resp=="registered"){
                        $('#mobile-valid').html('This mobile is already registerd with us..please try with another mobile number.' ).css('color', 'red');
                    }else if(resp=="notregistered"){
                        $('#mobile-valid').html('Congrats...! this mobile number is available to register').css('color', 'green');
                    }else if(resp=="notset"){
                        $('#mobile-valid').html('Please enter mobile number to check availability' ).css('color', 'red');
                    }                                        
                }
            });
            } else{
            document.getElementById("mobilevalid").style.display = '';
            $('#mobile-valid').html('Please enter 10 didgit mobile number to register...' ).css('color', 'red');
        }
        
    }
    function aadharAvail(aadhar)
    {                  
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";
        if (aadhar.length == 12) { 
            jQuery.ajax({                            
                url: baseurl+'/Nicdata/checkaadhar',
                type: "POST",
                data: {aadhar: aadhar},  
                error: function(){
                    document.getElementById("aadharvalid").style.display = '';
                    $('#aadhar-valid').html('Please enter aadhaar number to check availability' ).css('color', 'red');
                },
                success: function(resp){
                    document.getElementById("aadharvalid").style.display = '';
                    if(resp=="registered"){
                        $('#aadhar-valid').html('This aadhaar number is already registerd with us..please try with another aadhaar number.' ).css('color', 'red');
                    }else if(resp=="notregistered"){
                        $('#aadhar-valid').html('Congrats...! this aadhaar number is available to register').css('color', 'green');
                    }else if(resp=="notset"){
                        $('#aadhar-valid').html('Please enter aadhaar number to check availability' ).css('color', 'red');
                    }                                        
                }
            });
            } else{
            document.getElementById("aadharvalid").style.display = '';
            $('#aadhar-valid').html('Please enter 12 digit aadhaar number to register...' ).css('color', 'red');
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
</script>
<?php $this->renderPartial('//layouts/footer'); ?>