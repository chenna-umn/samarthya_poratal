<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">User Test Results</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12"> 
        <div class="col-xs-12">
        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/ExportReports';?>">
            <input type="button" value="Download Complete Information" class="btn btn-primary pull-right">
        </a>
    </div>
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
                <?php
                $distictUsername = User::model()->getDistinctUserName();
                $distinctDesignation = User::model()->getDistinctDesignation();
                $distinctStates = User::model()->getDistinctStates();
                $courses = Courses::model()->findAll();
                $testTypes = Tests::model()->findAll();
                ?>
                <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="panel panel-default">
                        <table class="table table-responsiv table-bordered">
                            <thead>
                                <tr>
                                    <th><select required name="userId" class="form-control" onchange="searchByUserName(this.value);">
                                            <option value="All" selected <?php if (isset($userId) && ($userId == "All")) { ?> selected <?php } ?>>All Users</option>
                                            <?php
                                            if (isset($distictUsername) && !empty($distictUsername)) {
                                                foreach ($distictUsername as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($userId) && ($userId == $value['id'])) { ?> selected <?php } ?>><?php echo $value['username'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>                                    
                                    <th>
                                        <select required name="userId" class="form-control" onchange="searchByDesignations(this.value);">
                                            <option value="All" selected <?php if (isset($designationId) && ($designationId == "All")) { ?> selected <?php } ?>>All Designations</option>
                                            <?php
                                            if (isset($distinctDesignation) && !empty($distinctDesignation)) {
                                                foreach ($distinctDesignation as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['designation'] ?>" <?php if (isset($designationId) && ($designationId == $value['designation'])) { ?> selected <?php } ?>><?php echo $value['designation'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <select required name="userId" class="form-control" onchange="searchByState(this.value);">
                                            <option value="All" selected <?php if (isset($stateId) && ($stateId == "All")) { ?> selected <?php } ?>>All States</option>
                                            <?php
                                            if (isset($distinctStates) && !empty($distinctStates)) {
                                                foreach ($distinctStates as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['state'] ?>" <?php if (isset($stateId) && ($stateId == $value['state'])) { ?> selected <?php } ?>><?php echo $value['state'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select></th>
                                    <th>
                                        <select required name="userId" class="form-control" onchange="searchByCourse(this.value);">
                                            <option value="All" selected <?php if (isset($courseId) && ($courseId == "All")) { ?> selected <?php } ?>>All Courses</option>
                                            <?php
                                            if (isset($courses) && !empty($courses)) {
                                                foreach ($courses as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($courseId) && ($courseId == $value['id'])) { ?> selected <?php } ?>><?php echo $value['courseName'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>                                    
                                    <th>
                                    <select required name="userId" class="form-control" onchange="searchByTestType(this.value);">
                                            <option value="All" selected <?php if (isset($testId) && ($testId == "All")) { ?> selected <?php } ?>>All Test Types</option>
                                            <?php
                                            if (isset($testTypes) && !empty($testTypes)) {
                                                foreach ($testTypes as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($testId) && ($testId == $value['id'])) { ?> selected <?php } ?>><?php echo $value['test_name'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>Score</th>
                                    <th>Result</th>                                    
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
                                                <?php echo $model['userName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['designation']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['state']; ?>
                                            </td>

                                            <td>
                                                <?php echo $model['courseName']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['testName']; ?>
                                            </td>

                                            <td>
                                                <?php echo $model['obtained_marks'].' / '.$model['total_marks']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['result']; ?>  
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
<script>    
    function searchByUserName(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByUserNameReports?id='+id;
        window.location = url;
        window.location.replace (url);
            
    }
    function searchByDesignations(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByDesignationsReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByState(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByStateReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByCourse(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByCourseReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByTestType(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByTestTypeReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
</script>
<?php $this->renderPartial('//layouts/footer'); ?>