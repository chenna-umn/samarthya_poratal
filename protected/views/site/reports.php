
<div class="container" style="background: #FFFFFF;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Number of people who have taken the test</h3>
    </div>
</div>
<div class="container" style="background: #FFFFFF;">
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
            
                <?php
                $distictUsername = User::model()->getDistinctUserName();
                $distinctDesignation = User::model()->getDistinctDesignation();
                $distinctStates = User::model()->getDistinctStates();
                $courses = Courses::model()->findAll();
                $testTypes = Tests::model()->findAll();
                ?>
            <div >
                <div class="row" style="background: rgb(19, 107, 155) none repeat scroll 0% 0%; padding-top: 10px; padding-bottom: 10px;">                    
                        <div class="col-xs-2" style="padding-left: 0px; padding-right: 0px;"><select required name="userId" class="form-control" onchange="searchByUserName(this.value);">
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
                            </select></div>
                        <div class="col-xs-2" style="padding-left: 2px; padding-right: 2px;"><select required name="userId" class="form-control" onchange="searchByDesignations(this.value);">
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
                            </select></div>
                        <div class="col-xs-2" style="padding-left: 2px; padding-right: 2px;"><select required name="userId" class="form-control" onchange="searchByState(this.value);">
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
                            </select></div>
                        <div class="col-xs-2" style="padding-left: 2px; padding-right: 2px;"><select required name="userId" class="form-control" onchange="searchByCourse(this.value);">
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
                            </select></div>
                        <div class="col-xs-2" style="padding-left: 2px; padding-right: 2px;color:#FFF;">Test Type</div>
                        <div class="col-xs-1" style="padding-left: 2px; padding-right: 2px;color:#FFF;">Score</div>
                        <div class="col-xs-1" style="padding-left: 2px; padding-right: 2px;color:#FFF;">Result</div>
                    </div>
                    <?php
                    if (isset($models) && !empty($models)) {
                        $i = 1;
                        foreach ($models as $model) {
                          
                                ?>
                                <div class="row" id="record<?php echo $model['id']; ?>" <?php if (($i % 2) == 1) { ?> style="background:#D9EDF7;border: 1px solid #E6E6E6;padding-top: 10px; padding-bottom: 10px;" <?php } else { ?> style="border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;padding-top: 10px; padding-bottom: 10px;" <?php } ?>>
                                    <div class="col-xs-2" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"> <?php echo $model['userName']; ?></div>
                                    <div class="col-xs-2" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"><?php echo $model['designation']; ?></div>
                                    <div class="col-xs-2" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"> <?php echo $model['state']; ?></div>
                                    <div class="col-xs-2" style="word-break: break-all;padding-left: 2px; padding-right: 2px;">   <?php echo $model['courseName']; ?>  </div>
                                    <div class="col-xs-2" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"> <?php echo $model['testName']; ?></div>
                                    <div class="col-xs-1" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"><?php echo $model['obtained_marks'] . '/' . $model['total_marks']; ?>  </div>
                                    <div class="col-xs-1" style="word-break: break-all;padding-left: 2px; padding-right: 2px;"> <?php echo $model['result']; ?> </div>
                                </div>
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
        var url = baseurl+'/site/searchByUserNameReports?id='+id;
        window.location = url;
        window.location.replace (url);
            
    }
    function searchByDesignations(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/site/searchByDesignationsReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByState(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/site/searchByStateReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByCourse(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/site/searchByCourseReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByTestType(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/site/searchByTestTypeReports?id='+id;
        window.location = url;
        window.location.replace (url)
    }
</script>
<?php $this->renderPartial('//layouts/footer_main'); ?>