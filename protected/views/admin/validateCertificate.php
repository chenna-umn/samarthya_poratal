<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Validate Certificate</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/ExportvalidateCertificate';?>">
            <input type="button" value="Download Complete Information" class="btn btn-primary pull-right">
        </a>
    </div>
    <div id="course-container" class="col-xs-12">              
        <div class="col-xs-12">             
            <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-info fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row margin-bottom-10">

                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                ));

                $this->widget('CListPager', array(
                    'pages' => $pages,
                ));
                ?>

            </div>
            <br>
            <div class="row">                
                <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="panel panel-default">
                        <table class="table table-responsiv table-bordered">
                            <thead>
                                <tr>
                                    <th>UserName</th>
                                    <th>Course name</th>
                                    <?php
                                    $tests = Tests::model()->findAll();
                                    foreach ($tests as $key => $value) {
                                        ?>
                                        <th><?php echo $value['test_name'] . ' Score' ?></th>
                                    <?php } ?>
                                    <th colspan="2" style="text-align: center;">Validate</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($models) && !empty($models)) {
                                    $i = 1;
                                    foreach ($models as $model) {
                                        $preTestScore = $postTestScore = $assesmentScore = array();
                                        $preTestScore = Testresults::model()->getTestScoreById(1, $model['user_id'], 'Not Applicable', $model['course_id']);
                                        $assesmentScore = Testresults::model()->getTestScoreById(2, $model['user_id'], 'Pass', $model['course_id']);
                                        $postTestScore = Testresults::model()->getTestScoreById(3, $model['user_id'], 'Not Applicable', $model['course_id']);
                                        if (isset($preTestScore) && !empty($preTestScore) && isset($postTestScore) && !empty($postTestScore) && isset($assesmentScore) && !empty($assesmentScore)) {
                                            ?>
                                            <tr id="record<?php echo $model['id']; ?>" <?php if (($i % 2) == 0) { ?>class="info" <?php } ?>>
                                                <td>
                                                    <?php echo User::model()->getuserName($model['user_id']); ?>
                                                </td>
                                                <td>
                                                    <?php echo Courses::model()->getCourseName($model['course_id']); ?>
                                                </td>
                                                <td> <?php echo $preTestScore['obtained_marks'] . '/' . $preTestScore['total_marks'] ?> </td>
                                                <td> <?php echo $assesmentScore['obtained_marks'] . '/' . $assesmentScore['total_marks'] ?> </td>
                                                <td> <?php echo $postTestScore['obtained_marks'] . '/' . $postTestScore['total_marks'] ?> </td>
                                                <td><a  target="_blank" href="<?php echo Yii::app()->request->baseUrl.'/admin/viewCertificate?courseId='.$model['course_id'].'&userId='.$model['user_id'];?>">
                                                        <button type="button" style="margin-right: 15px;" class="btn btn-primary pull-right">View</button>
                                                    </a></td>
                                                    <?php $checkGenerated = Generatecertificate::model()->findAll('course_id=:course_id AND user_id=:user_id',array('course_id'=>$model['course_id'],'user_id'=>$model['user_id'])); 
                                                        if(isset($checkGenerated) && !empty($checkGenerated)){
                                                    ?>   
                                                    <td><a href="<?php echo Yii::app()->request->baseUrl.'/admin/generateCertificate?courseId='.$model['course_id'].'&userId='.$model['user_id'];?>">
                                                        <button type="button" style="margin-right: 15px;" class="btn btn-default pull-right" value="View">Re-Generate</button>
                                                    </a></td>
                                                    
                                                    <?php }else{ ?>
                                                    <td><a href="<?php echo Yii::app()->request->baseUrl.'/admin/generateCertificate?courseId='.$model['course_id'].'&userId='.$model['user_id'];?>">
                                                        <button type="button" style="margin-right: 15px;" class="btn btn-primary pull-right" value="View">Generate</button>
                                                    </a></td>
                                                    <?php } ?>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                } else {
                                    ?>
                                <div class="alert alert-info fade in">
                                    <strong>Oops!</strong> Currently, No one attempted Any Test.
                                </div>
                            <?php }
                            ?>

                            </tbody>
                        </table>
                    </div>                   
                </div>
            </div>
            <div class="row margin-bottom-10">
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                ));

                $this->widget('CListPager', array(
                    'pages' => $pages,
                ));
                ?>
            </div>
            <br>
        </div>
    </div>
</div>

<?php $this->renderPartial('//layouts/footer'); ?>