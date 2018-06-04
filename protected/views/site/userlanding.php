<div class="container">
    <br>
    <div class="col-xs-12">
        <h3 class="featurette-heading">Courses</h3>
        <hr class="featurette-divider">
        <p>Human, Livestock population and other living beings depend on natural resources for their different 

            requirements in both space and time. Natural resources like land, water and vegetation are limited and 

            inadequate to meet the growing requirements of different categories of living beings. In order to meet 

            such requirements, judicious and optimal utilization of natural resources is the need of the hour. For 

            development and management of such natural resources to meet growing requirements of different 

            categories of living beings, Government of India have designed and launched several programmes since 

            independence. However, these programmes were not utilized to the extent desired due to various factors 

            like lack of awareness among primary and secondary stakeholders, inadequate people’s participation, 

            deficiencies in capacity and training programmes designed to field staff, lack of interest among PRIs for 

            involvement and in the process lot of money invested and the results could not be properly quantified...<a href="<?php echo Yii::app()->request->baseUrl . '/site/Download?name=Content_about_all_courses.pdf&path=uploads/coursePDF'; ?>">Read More...</a></p>
        <br/>
    </div>
</div>
<!--   ---------------------- Start Details Page video Content -----------------------    -->

<div class="container">

    <?php
    if (isset($courses) && !empty($courses)) {
        foreach ($courses as $key => $course) {
            ?>
            <div class="col-xs-12 col-xs-6 col-md-3" style="margin-bottom: 10px;">
                <div class="course-box">
                    <div class="course-header"><h5 class="course-title">Course <?php echo $course->courseNumber; ?></h5></div>
                    <div align="center" class="course-img"><a href="<?php echo Yii::app()->request->baseUrl . '/site/details?id=' . $course->id; ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/uploads/courseImages/' . $course->courseImage; ?>" /></a>
                    </div>
                    <div class="course-footer"><a href="<?php echo Yii::app()->request->baseUrl . '/site/details?id=' . $course->id; ?>"><?php echo $course->courseName; ?><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/course-arrow.png" class="pull-right" /></a></div>
                    <div class="course-menu">
                        <?php $Assigntests = Assigntests::model()->findAll('status=:status AND course_id=:course_id AND test_id=:test_id', array('status' => 1, 'course_id' => $course->id,'test_id'=>1));
                        ?>
                        <ul>
                            <?php
                            if (isset($Assigntests) && !empty($Assigntests)) {

                                foreach ($Assigntests as $key => $value) {
                                    $checkTestStatus = Tests::model()->getTestStatus($value->course_id, $value->test_id);
                                    ?>
                                    <?php
                                    if ($checkTestStatus['status'] == 0) {
                                        ?>
                                        <li><a href="javascript:void(0);" onclick="showModal('<?php echo $checkTestStatus['message']; ?>')"><?php echo Tests::model()->getTestName($value->test_id); ?></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/takeTest?id=' . $value->id; ?>"><?php echo Tests::model()->getTestName($value->test_id); ?></a></li>
                                    <?php } ?>

                                    <?php
                                }
                            }
                            ?>
                          
                            
                            <?php
                            if (isset($Assigntests) && !empty($Assigntests)) {

                                foreach ($Assigntests as $key => $value) { 
                                    $checkTestStatus = Tests::model()->getPreTestStatus($value->course_id, 1);
                                    ?>
                                    <?php
                                    if ($checkTestStatus['status'] == 0) {
                                        ?>
                                        <li><a href="javascript:void(0);" onclick="showModal('<?php echo $checkTestStatus['message']; ?>')">Details</a></li>
                                        <li><a href="javascript:void(0);" onclick="showModal('<?php echo $checkTestStatus['message']; ?>')">Go to Module</a></li>
                                        
                                    <?php } else { ?>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/details?id=' . $course->id; ?>">Details</a></li>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/Modules?id=' . $course->id; ?>">Go to Module</a></li>
                                        
                                    <?php } ?>
                                        <?php
                                }
                            }
                            ?>
                        <ul>
                            <?php $Assigntests = Assigntests::model()->findAll('status=:status AND course_id=:course_id AND test_id=:test_id', array('status' => 1, 'course_id' => $course->id,'test_id'=>2));
                        ?>
                            <?php
                            if (isset($Assigntests) && !empty($Assigntests)) {

                                foreach ($Assigntests as $key => $value) {
                                    $checkTestStatus = Tests::model()->getTestStatus($value->course_id, $value->test_id);
                                   
                                    ?>
                                    <?php
                                    if ($checkTestStatus['status'] == 0) {
                                        ?>
                                        <li><a href="javascript:void(0);" onclick="showModal('<?php echo $checkTestStatus['message']; ?>')"><?php echo Tests::model()->getTestName($value->test_id); ?></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/takeTest?id=' . $value->id; ?>"><?php echo Tests::model()->getTestName($value->test_id); ?></a></li>
                                    <?php } ?>

                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>   
            </div>


            <?php
        }
    } else {
        ?>
        <div class="row margin-bottom-10">
            <div class="info1 alert alert-warning fade in">
                <strong>  Oops... There are No Courses Available Currently...</strong>
            </div>
        </div>
    <?php } ?>
</div>
<div id="myModalf" class="modal fade">
    <div class="modal-dialog" style="top : 25%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #f1f1f1;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:red;">&times;</button>
                <h4 class="modal-title">Hi...<?php echo Yii::app()->user->memname; ?></h4>
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
        
    });
    function showModal(status){
      
        document.getElementById("message1").innerHTML=status;
        $('#myModalf').modal('show');
    }
</script>
<script type="text/javascript">
    
        window.history.forward();
        function noBack()
        {          
          //alert("Note :You are not allowed to go  to previous page from this page.");
            window.history.forward();
            
        }
</script>
<?php $this->renderPartial('//layouts/footer_main'); ?>