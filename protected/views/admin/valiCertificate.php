<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Validate Certificate</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
        <form action="<?php echo Yii::app()->request->baseUrl . '/admin/checkCertificate'; ?>" method="POST"  enctype="multipart/form-data">               

            <div id="form-Div" class="row">                        
                <div class="col-xs-6">
                    Enter Certificate Id To Validate
                </div>
                <div class="col-xs-6">                            
                    <input  name="searchvalue"  type="text" required class="form-control" placeholder="Certificate Id" <?php if(isset($code) && !empty($code)){?> value="<?php echo $code; ?>" <?php } ?>/>
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

    <div id="course-container" class="col-xs-12">              
        <div class="col-xs-12">
            <br>
            <div class="row">                
                <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                    
                     <div class="col-xs-2"></div>
                    <div class="col-xs-8">
                        <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="row margin-bottom-10">
                            <div class="info1 alert alert-info fade in">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo Yii::app()->user->getFlash('success'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (Yii::app()->user->hasFlash('error')) { ?>
                        <div class="row margin-bottom-10">
                            <div class="info1 alert alert-error fade in">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo Yii::app()->user->getFlash('error'); ?>
                            </div>
                        </div>
                    <?php } ?>
                        <table class="table table-responsiv table-bordered">

                            <tbody>
                                <?php
                                if (isset($models) && !empty($models)) {
                                                                       ?>
                                    <tr class="info">
                                        <td>User Name</td>
                                        <td><?php echo $models['staff_name'];  ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Functionary Name</td>
                                        <td><?php echo $models['functionary_name'];  ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td>Adhaar</td>
                                        <td><?php echo $models['adhaar'];  ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Mobile</td>
                                        <td><?php echo $models['mobile'];  ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td>Email</td>
                                        <td><?php echo $models['email'];  ?></td>
                                    </tr>
                                <?php } ?> 
                            </tbody>
                        </table>
                        </div>
                          <div class="col-xs-2"></div>             
                </div>
            </div>

            <br>
        </div>
    </div>
</div>

<?php $this->renderPartial('//layouts/footer'); ?>