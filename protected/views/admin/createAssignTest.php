<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Manage Tests</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12">
        <div class="col-xs-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "testslist") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/tests'; ?>">Tests List</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createtests") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/createTest'; ?>">Add a Test</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "assigntest") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/assignTest'; ?>">Assigned Tests</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createassigntest") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/createassignTest'; ?>">Assigned New Test</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "uploadqtns") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/testQuestions'; ?>">Test Questions</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createqtns") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/createTestQuestions'; ?>">Upload Bulk Questions</a></li>
            </ul>
        </div>       
        <div class="col-xs-9">             
            <?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-danger fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                </div>
            <?php } ?>

            <form action="<?php echo Yii::app()->request->baseUrl . '/admin/CreateAssignTest'; ?>" method="POST"  enctype="multipart/form-data">               
                <div class="row">
                    <div class="col-xs-12">
                        <h4 id="courseDetailHeading"><B>Add Test Assignment</B></h4><hr/>
                    </div>
                </div>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Course Name:
                    </div>
                    <?php $course = Courses::model()->findAll();
                    ?>
                    <div class="col-xs-12">
                        <select required name="Assigntests[course_id]" class="form-control" >
                            <option value="">Select Course Name</option>
                            <?php if (isset($course) && !empty($course)) {
                                foreach ($course as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['courseName'] ?></option>                                
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div> <br>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Test Name:
                    </div>
                    <?php $tests = Tests::model()->findAll();
                    ?>
                    <div class="col-xs-12">
                        <select required name="Assigntests[test_id]" class="form-control" >
                            <option value="">Select Test Name</option>
                            <?php if (isset($tests) && !empty($tests)) {
                                foreach ($tests as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['test_name'] ?></option>                                
    <?php }
} ?>
                        </select>
                    </div>
                </div><br>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Duration (In Minutes):
                    </div>
                    <div class="col-xs-12">
                        <input type="number" name="Assigntests[duration]"  required class="form-control" placeholder="Duration" min="1"/>
                    </div>
                </div><br>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Total Questions:
                    </div>
                    <div class="col-xs-12">
                        <input type="number" name="Assigntests[total_questions]"  required class="form-control" placeholder="Total Questions" min="1"/>
                    </div>
                </div><br>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Total Marks:
                    </div>
                    <div class="col-xs-12">
                        <input type="number" name="Assigntests[total_marks]"  required class="form-control" placeholder="Total Marks" min="0"/>
                    </div>
                </div><br>

                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Pass Marks:
                    </div>
                    <div class="col-xs-12">
                        <input type="number" name="Assigntests[pass_marks]"  required class="form-control" placeholder="Pass Marks" min="0"/>
                    </div>
                </div><br>
                <div id="form-Div" class="row">
                    <div class="col-xs-12">
                        Test Status:
                    </div>
                    <div class="col-xs-12">
                        <select name="Assigntests[status]" required class="form-control"> 
                            <option value="1" selected>Active</option>
                            <option value="0" >In-Active</option>
                        </select>
                    </div>
                </div>                   
                <br>
                <div id="form-Div" class="row">

                    <div class="col-xs-12">
                        <input type="submit" id="CourseDetailsBttn" class="btn btn-primary pull-right" value="Submit"/>
                        <input type="reset" id="CourseDetailsBttn" class="btn btn-default pull-right" value="Reset"/>
                    </div>
                </div>               
            </form>            
        </div>
    </div>
</div>

<?php $this->renderPartial('//layouts/footer'); ?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info1").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY
);
?>
