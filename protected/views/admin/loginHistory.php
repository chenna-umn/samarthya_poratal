<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">User Login History</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/ExportLoginHistory';?>">
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
                                    <th>Logged In Time</th>
                                    <th>Logged Out Time</th>                                              
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($models) && !empty($models)) {
                                    $i = 1;
                                    foreach ($models as $model) {
                                        $loginHistory = Loginhistory::model()->getLastLoginTime($model['user_id']);
                                       
                                        ?>
                                
                                        <tr id="record<?php echo $model['id']; ?>" <?php if (($i % 2) == 0) { ?>class="info" <?php } ?>>
                                            <td>
                                                <a href="<?php echo Yii::app()->request->baseUrl.'/admin/userLoginHistory?id='.$model['user_id'];?>" title="Click to get Full Login History"><?php echo $model['userName']; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $loginHistory[0]['login_time']; ?>
                                            </td>
                                            <?php if (isset($loginHistory[0]['logout_time']) && !empty($loginHistory[0]['logout_time'])) { ?>
                                                <td>
                                                    <?php echo $loginHistory[0]['logout_time']; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <?php echo 'Not Logged Out Successfully.'; ?>
                                                </td>
                                            <?php } ?>

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