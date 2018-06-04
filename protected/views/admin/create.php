<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Manage Courses</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12">
        <div class="col-xs-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "courselist") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/index'; ?>">Courses List</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createcourse") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/create'; ?>">Add a Course</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "coursedetails") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/courseDetails'; ?>">Course Details List</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createcoursedetails") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/createCourseDetails'; ?>">Add Course Details</a></li>
            
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
            
            <form action="<?php echo Yii::app()->request->baseUrl.'/admin/create';?>" method="POST"  enctype="multipart/form-data">               
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 id="courseDetailHeading"><B>Add Course Details</B></h4><hr/>
                        </div>
                    </div>
                    <div id="form-Div" class="row">
                        <div id="view-courseName2-label" class="col-xs-12">
                            Course Name:
                        </div>
                        <div class="col-xs-12">
                            <input  name="Courses[courseName]"  required class="form-control" placeholder="Course Name"/>
                        </div>
                    </div>
                    <div id="form-Div" class="row">
                        <div class="col-xs-12">
                            Course Image:
                        </div>
                        <div class="col-xs-12">
                            <input name="image"  type="file" class="form-control" required/>
                        </div>
                    </div>
                    <div id="form-Div" class="row">
                        <div id="view-courseName2-label" class="col-xs-12">
                            Description :
                        </div>
                        <div class="col-xs-12">
                            <textarea  name="Courses[description]"  required class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div id="form-Div" class="row">
                        <div class="col-xs-12">
                            PDFlink:
                        </div>
                        <div class="col-xs-12">
                            <input name="PDFlink"  type="file" class="form-control" required/>
                        </div>
                    </div>
                    <div id="form-Div" class="row">

                        <div class="col-xs-12">
                            Course Order
                        </div>

                        <div class="col-xs-12">
                            <input name="Courses[order_by]" type="number" class="form-control" required min="1"/>
                        </div>

                    </div>
                    <div id="form-Div" class="row">

                        <div class="col-xs-12">
                            Course Status:
                        </div>

                        <div class="col-xs-12">
                            <select name="Courses[status]" required class="form-control"> 
                                <option value="1" selected>Active</option>
                                <option value="0" >In-Active</option>
                            </select>
                        </div>

                    </div>                   
                <br>
                    <div id="form-Div" class="row">

                        <div class="col-xs-12">
                            <input type="submit" id="CourseDetailsBttn" class="btn btn-primary pull-right" value="Add Course"/>
                            <input type="reset" id="CourseDetailsBttn" class="btn btn-default pull-right" value="Reset"/>
                        </div>
                    </div>               
            </form>            
        </div>
    </div>
</div><br>
<?php $this->renderPartial('//layouts/footer'); ?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info1").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY
);
?>
