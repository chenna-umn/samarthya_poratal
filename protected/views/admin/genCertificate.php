<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Generated Certificates</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/ExportgeneratedCertificate';?>">
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
                <p style="padding-left: 15px;">Result Count : <?php echo $count; ?></p>
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
                                    <th>User Name</th>
                                    <th>Course Name</th>
                                    <th>Marks</th>    
                                    <th>Generated On</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($models) && !empty($models)) {
                                    $i = 1;
                                    foreach ($models as $model) {
                                        ?>
                                        <tr id="record<?php echo $model['id']; ?>" <?php if (($i % 2) == 0) { ?>class="info" <?php } ?>>
                                            <td>
                                                <?php echo User::model()->getuserName($model['user_id']); ?>
                                            </td>
                                            <td>
                                                <?php echo $model['courseName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['marks']; ?>
                                            </td>

                                            <td>
                                                <?php echo $model['created_on']; ?>  
                                            </td>                                            
                                        </tr>
                                        <?php
                                        $i++;
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