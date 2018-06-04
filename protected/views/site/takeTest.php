<div class="container" style="background: #fff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Course- <?php echo $course->courseNumber; ?><span class="text-muted"><?php echo '   ' . Tests::model()->getTestName1($assignTests->test_id); ?></span>
            <div class="time-left pull-right">
                <!--<spna class="text-muted" id="starttime"></spna>-->
                <spna class="text-muted" id="endtime"></spna>
                <spna class="text-muted" id="showtime"></spna></div>

        </h3>
        <hr class="featurette-divider">
    </div>    
</div>
<div class="container" style="background: #fff;">
    <div class="col-xs-12">
        <div class="row featurette">
            <div class="col-md-8">
                <form role="form" name="test" id="test" action="<?php echo Yii::app()->request->baseUrl . '/site/testResult'; ?>" method="post">
                    <input type="hidden" name="timeconsumedmin" id="timeconsumedmin">
                    <input type="hidden" name="timeconsumedsec" id="timeconsumedsec">
                    <input type="hidden" name="totalQuestions" id="totalQuestions" value="<?php echo $assignTests->total_questions; ?>">
                    <input type="hidden" name="totalQuestionsCurrent" id="totalQuestionsCurrent" value="<?php echo count($testQuestions); ?>">
                    <input type="hidden" name="assignTestId" id="assignTestId" value="<?php echo $assignTests->id; ?>">
                    <input type="hidden" name="displayvalue" id="displayvalue" value="1">
                    <?php
                    if (isset($testQuestions) && !empty($testQuestions)) {
                        $i = 1;
                        foreach ($testQuestions as $key => $value) {
                            ?>
                            <div id="qtndisplay<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;" <?php
                    } else {
                        $j = $i;
                    }
                    ?>>

                                <input type="hidden" name="questions[<?php echo $value['id']; ?>]" value="<?php echo $value['id']; ?>">
                                <input type="hidden" name="correctAns[<?php echo $value['id']; ?>]" value="<?php echo $value['answer']; ?>">
                                <input type="hidden" id="qtn<?php echo $i; ?>" value="<?php echo $value['id']; ?>">
                                <div class="questions-count" >
                                    <span class="text-muted">Q <?php echo $i; ?>:</span>
                                </div><div id="qtn<?php echo $value['id']; ?>" name="qtn<?php echo $value['id']; ?>" class="questions-text"><?php echo $value['question']; ?></div>

                                <div class="multiple-choice">
                                    <div class="radio">
                                        <label><input type="radio" id="answers<?php echo $value['id']; ?>a" name="answers[<?php echo $value['id']; ?>]" value="1"><?php echo $value['option1']; ?></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" id="answers<?php echo $value['id']; ?>b" name="answers[<?php echo $value['id']; ?>]" value="2"><?php echo $value['option2']; ?></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" id="answers<?php echo $value['id']; ?>c" name="answers[<?php echo $value['id']; ?>]" value="3"><?php echo $value['option3']; ?></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" id="answers<?php echo $value['id']; ?>d" name="answers[<?php echo $value['id']; ?>]" value="4"><?php echo $value['option4']; ?></label>
                                    </div>
                                </div>

                            </div> 


        <?php $i++;
    }
    ?>
                        <br>
                        <button type="button" class="btn btn-default" style="display:none;" id="prevQtn" onclick="prevQuestion()">Previous</button>
                        <button type="button" class="btn btn-default" onclick="nextQuestion()" id="nextQtn">Next</button>
                        <button type="button" class="btn btn-primary" id="submitQtn" style="display:none;" onclick="submitQuestion()">Submit</button>
                        <br/>
                    </form>
                </div>
<?php } ?>


            <div class="col-md-4"><img class="featurette-image img-responsive center-block" src="<?php echo Yii::app()->request->baseUrl . '/uploads/courseImages/' . $course->courseImage; ?>" alt="Post Test Image"></div>
        </div>
    </div>
</div>
<div class="bs-example"> 
    <div id="myModal2" class="modal fade" data-backdrop="static" style="background-color: rgba(250,250, 250, 0.5);">
        <div class="modal-dialog" style="top: 30%;">
            <div class="modal-content">
                <div class="modal-header" style="background: #f1f1f1;"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:red;">&times;</button>
                    <h4 class="modal-title">Hello...! <?php echo Yii::app()->user->memname; ?></h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 16px;color:red;">Please select an option</p>                                        
                </div> 
                <div class="modal-footer" style="background: #f1f1f1;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal11" class="modal fade" data-backdrop="static" style="background-color: rgba(250,250, 250, 0.5);">
    <div class="modal-dialog" style="top : 25%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #f1f1f1;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:red;">&times;</button>
                <h4 class="modal-title">Hi...<?php echo Yii::app()->user->firstname; ?></h4>
            </div>
            <div class="modal-body">
                <span id="message1"></span>

            </div>
            <div class="modal-footer" style="background: #f1f1f1;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">        
    $( document ).ready(function() {
        
    });
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
    function prevQuestion(value){
        var  value = document.getElementById("displayvalue").value;
        var radiooption = document.getElementById('qtn'+value).value; 
        if ((document.getElementById('answers'+radiooption+'a').checked) || (document.getElementById('answers'+radiooption+'b').checked) || (document.getElementById('answers'+radiooption+'c').checked) || (document.getElementById('answers'+radiooption+'d').checked)) {    
            var  toatlQtns = document.getElementById("totalQuestionsCurrent").value;        
        var x=parseInt(value)-parseInt(1);        
        if(parseInt(x)==parseInt(1)){            
            document.getElementById('prevQtn').style.display = 'none'; 
        }
        if(parseInt(x)<toatlQtns){    
            document.getElementById('nextQtn').style.display = '';
            document.getElementById("displayvalue").value=x;
            document.getElementById('qtndisplay'+value).style.display = 'none';
            document.getElementById('qtndisplay'+x).style.display = '';
            document.getElementById('submitQtn').style.display = 'none';
        }
        }else{
            $('#myModal2').modal('show');	
        }
    }
    
    function submitQuestion(value){
        var  value = document.getElementById("displayvalue").value;
        var radiooption = document.getElementById('qtn'+value).value; 
        if ((document.getElementById('answers'+radiooption+'a').checked) || (document.getElementById('answers'+radiooption+'b').checked) || (document.getElementById('answers'+radiooption+'c').checked) || (document.getElementById('answers'+radiooption+'d').checked)) {    
            document.getElementById("test").submit();
        }else{
            $('#myModal2').modal('show');	
        }
    }
    function nextQuestion(){       
        
        
        var  value = document.getElementById("displayvalue").value;        
        var radiooption = document.getElementById('qtn'+value).value; 
        if ((document.getElementById('answers'+radiooption+'a').checked) || (document.getElementById('answers'+radiooption+'b').checked) || (document.getElementById('answers'+radiooption+'c').checked) || (document.getElementById('answers'+radiooption+'d').checked)) {        
        var  toatlQtns = document.getElementById("totalQuestionsCurrent").value;        
        var x=parseInt(value)+parseInt(1);
        if(parseInt(x)==toatlQtns){            
            document.getElementById('nextQtn').style.display = 'none';
            document.getElementById('submitQtn').style.display = '';
        }
        if(parseInt(value)<toatlQtns){
            
            document.getElementById("displayvalue").value=x;
            document.getElementById('prevQtn').style.display = '';
            document.getElementById('qtndisplay'+value).style.display = 'none';
            document.getElementById('qtndisplay'+x).style.display = '';
            
        }
      }else{
           $('#myModal2').modal('show');	
      } 
    }
</script>
<script language ="javascript" >
    var tim;
       
    var min = '<?php echo ($assignTests->duration - 1); ?>';
    var sec = 60;
    var f = new Date();
    function f1() {
        f2();
        document.getElementById("starttime").innerHTML = "Your started your Exam at " + f.getHours() + ":" + f.getMinutes();
             
          
    }
    function f2() {
        if (parseInt(sec) > 0) {
            sec = parseInt(sec) - 1;
            document.getElementById("showtime").innerHTML = "Time Left 00:"+min+":" + sec+" Hrs";
            document.getElementById("timeconsumedmin").value = min;
            document.getElementById("timeconsumedsec").value = sec;
            tim = setTimeout("f2()", 1000);
        }
        else {
            if (parseInt(sec) == 0) {
                min = parseInt(min) - 0;
                if (parseInt(min) == 0) {
                    clearTimeout(tim);
                    submitForm();                        
                }
                else {
                    sec = 60;
                    document.getElementById("showtime").innerHTML = "Time Left 00:" + min + ":" + sec + " Hrs";
                    tim = setTimeout("f2()", 1000);
                }
            }
               
        }
    }
    function submitForm() {
        document.getElementById("test").submit();
    }
    $(document).ready(function() { 
        f1();
        window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
    });
</script>


<script type="text/javascript">
    
        window.history.forward();
        function noBack()
        {          
             document.getElementById("message1").innerHTML='Note :You are not allowed to go  to previous page from this page.';
                $('#myModal11').modal('show');
          //alert("Note :You are not allowed to go  to previous page from this page.");
            window.history.forward();
            
        }
</script>


<?php $this->renderPartial('//layouts/footer_test'); ?>