
<div class="container">
    <div id="course-container" class="col-xs-12">
        <div class="col-xs-3"></div> 
            
        <div class="col-xs-6">             
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
            
            <form action="<?php echo Yii::app()->request->baseUrl.'/site/ForgotPasswordSendLink';?>" method="POST"  enctype="multipart/form-data">               
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 id="courseDetailHeading"><B>Forgot Password</B></h4><hr/>
                        </div>
                    </div>                    
                    <div id="form-Div" class="row">
                        <div class="col-xs-6">
                            Enter Your Email to retrieve Password
                        </div>
                        <div class="col-xs-6">
                            <input  name="email" type="email" required class="form-control" placeholder="Enter Email"/>
                            <lable id="message"></lable>
                        </div>
                    </div>                   
                                      
                <br>
                    <div id="form-Div" class="row">
                        <div class="col-xs-12">
                            <input type="submit" id="CourseDetailsBttn" class="btn btn-primary pull-right" value="Submit"/>
                           
                        </div>
                    </div> 
                <br>
            </form>            
        </div>
        <div class="col-xs-3"></div> 
    </div>
</div>

<?php $this->renderPartial('//layouts/footer_main'); ?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info1").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY
);
?>
