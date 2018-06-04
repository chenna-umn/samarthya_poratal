<div class="container" style="height: 350px;background: #fff;" oncontextmenu="rightclick();return false">
    <br/>
    <br/>
    <div class="col-xs-12">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <?php
            if (isset($testResults) && !empty($testResults)) {
                $course = Courses::model()->findByPk($testResults->course_id);
                ?>        
                
                
                <div class="col-xs-12">
                    <div class="bs-example"> 
                        <div id="myModal" class="modal fade" data-backdrop="static" style="background-color: rgba(250,250, 250, 0.5);">
                            <div class="modal-dialog" style="top: 30%;">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: #f1f1f1;"> 
                                        
                                        <h4 class="modal-title">Test Result</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo 'You Have ' . $display .' '.Tests::model()->getTestName1($testResults->test_type_id). '  in Course ' . $course->courseNumber . ' (' . $course->courseName . ')'; ?></p>                                        
                                    </div>
                                    <div class="modal-footer" style="background: #f1f1f1;">
                                        <?php if ($testResults->test_type_id == 1) { ?>
                                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/details?id=' . $testResults->course_id; ?>" style="color:#FFF"> <button type="button" class="btn btn-primary" >Go To Details Page</button></a>
                                            <?php
                                        } elseif ($testResults->test_type_id == 2 && $testResults->result == "Pass") {
                                            $assignedTest = Assigntests::model()->find('course_id=:course_id AND test_id=:test_id', array('course_id' => $testResults->course_id, 'test_id' => 3));
                                            ?>
                                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/takeTest?id=' . $assignedTest->id; ?>" style="color:#FFF"><button type="button" class="btn btn-primary" >Take Post Test</button></a>       
                                            <?php
                                        } elseif ($testResults->test_type_id == 2 && $testResults->result == "Fail") {
                                            $assignedTest = Assigntests::model()->find('course_id=:course_id AND test_id=:test_id', array('course_id' => $testResults->course_id, 'test_id' => 2));
                                            ?>
                                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/details?id=' . $testResults->course_id; ?>" style="color:#FFF"> <button type="button" class="btn btn-default" >Go To Details Page</button></a>
                                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/takeTest?id=' . $assignedTest->id; ?>" style="color:#FFF"><button type="button" class="btn btn-primary" >Take <?php echo Tests::model()->getTestName($testResults->test_type_id) . ' Again'; ?></button>   </a>    
                                        <?php } elseif ($testResults->test_type_id == 3) { ?>
                                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/testRelutsMember'?>" style="color:#FFF"><button type="button" class="btn btn-primary">View Test Results</button></a>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     
                    </body>
                    </html>                                		                                		
                </div>
            <?php } ?>
        </div>
        <br/>
        <div class="col-xs-3"></div>
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
    $(document).ready(function(){	
        $('#myModal').modal('show');	
    });
</script>
<script type="text/javascript">
    
        window.history.forward();
        function noBack()
        {          
//             document.getElementById("message1").innerHTML='Note :You are not allowed to go  to previous page from this page.';
//                $('#myModal11').modal('show');
          //alert("Note :You are not allowed to go  to previous page from this page.");
            window.history.forward();
            
        }
</script>
<script type="text/javascript">
    document.onkeydown = function(e) {
var key;
if (window.event) {
key = event.keyCode
}
else {
var unicode = e.keyCode ? e.keyCode : e.charCode
key = unicode
}
switch (key) {//event.keyCode
case 116: //F5 button
alert("Refresh Page Not Allowed");
event.returnValue = false;
key = 0; //event.keyCode = 0;
return false;
case 82: //R button
if (event.ctrlKey) {
alert("Refresh Page Not Allowed");
event.returnValue = false;
key = 0; //event.keyCode = 0;
return false;
}
}
}
function rightclick(){
    alert("Right Click Disbled");
}
 jQuery(document).ready(function($) {
var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
  if (window.history && window.history.pushState) {

    $(window).on('popstate', function() {
      var hashLocation = location.hash;
      var hashSplit = hashLocation.split("#!/");
      var hashName = hashSplit[1];

      if (hashName !== '') {
        var hash = window.location.hash;
        if (hash === '') {
          alert('Back button was not allowed you are redirecting to home page.');
          window.location=baseurl+'/site/landing'
        }
      }
    });

    window.history.pushState('forward', null, './#forward');
  }

});  
</script>

<!--   ---------------------- Start Details Page video Content -----------------------    -->


<?php $this->renderPartial('//layouts/footer_test'); ?>