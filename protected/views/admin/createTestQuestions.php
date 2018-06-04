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
            <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-success fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
            
            <form action="<?php echo Yii::app()->request->baseUrl.'/admin/createTestQuestions';?>" method="POST"  enctype="multipart/form-data">               
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 id="courseDetailHeading"><B>Upload Test Questions</B></h4><hr/>
                        </div>
                    </div>
                    <div id="form-Div" class="row">
                        <div class="col-xs-12">
                            Upload File:
                        </div>
                        <div class="col-xs-6">
                            <input name="uploadFile"  type="file" class="form-control" required/>
                        </div>
                        <div class="col-xs-6">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/site/Download?name=Samarthya-Test-sample-document.xls&path=uploads/coursePDF'; ?>">Download Sample Excel Sheet</a>
                        </div>
                    </div>             
                <br>
                    <div id="form-Div" class="row">

                        <div class="col-xs-12">
                            <input type="submit" id="CourseDetailsBttn" class="btn btn-primary pull-right" value="Add Test"/>
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
