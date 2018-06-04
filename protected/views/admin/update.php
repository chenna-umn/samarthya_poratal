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
            <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info info1 alert alert-success fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="infor alert alert-danger fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                </div>
            <?php } ?>
            <form action="<?php echo Yii::app()->request->baseUrl . '/admin/updateCourse?id=' . $model['id']; ?>" method="POST"  enctype="multipart/form-data">               
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
                        <input  name="Courses[courseName]"  required class="form-control" placeholder="Course Name" value="<?php echo $model->courseName; ?>"/>
                    </div>
                </div>
                <div id="form-Div" class="row">
                    <div class="col-xs-12">
                        Course Image:
                    </div>
                    <div class="col-xs-6">
                        <input name="image"  type="file" class="form-control"/>
                    </div>
                    <div class="col-xs-6">
                        <img class="img-responsive" style="width:100px;height: 100px;" src="<?php echo Yii::app()->request->baseUrl . '/uploads/courseImages/' . $model['courseImage']; ?>"/>
                    </div>
                </div>
                <div id="form-Div" class="row">
                    <div id="view-courseName2-label" class="col-xs-12">
                        Description :
                    </div>
                    <div class="col-xs-12">
                        <textarea  name="Courses[description]"  required class="form-control" placeholder="Description"> <?php echo $model->description; ?></textarea>
                    </div>
                </div>
                <div id="form-Div" class="row">
                    <div class="col-xs-12">
                        PDF Link:
                    </div>
                    <div class="col-xs-6">
                        <input name="PDFlink"  type="file" class="form-control"/>
                    </div>
                    <div class="col-xs-6">
                        <span> <?php echo $model->PDFlink; ?></span>
                    </div>
                </div>
                <div id="form-Div" class="row">

                    <div class="col-xs-12">
                        Course Order
                    </div>

                    <div class="col-xs-12">
                        <input name="Courses[order_by]" type="number" class="form-control" value="<?php echo $model->order_by; ?>" required min="1"/>
                    </div>

                </div>
                <div id="form-Div" class="row">

                    <div class="col-xs-12">
                        Course Status:
                    </div>

                    <div class="col-xs-12">
                        <select name="Courses[status]" required class="form-control"> 
                            <option value="1" <?php if (isset($model->order) && ($model->order == 1)) { ?> selected <?php } ?>>Active</option>
                            <option value="0" <?php if (isset($model->order) && ($model->order == 0)) { ?> selected <?php } ?>>In-Active</option>
                        </select>
                    </div>

                </div>                   
                <br>
                <div id="form-Div" class="row">

                    <div class="col-xs-12">
                        <input type="submit" id="CourseDetailsBttn" class="btn btn-primary pull-right" value="Update"/>
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
