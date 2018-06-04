<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Manage Tests</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">    
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/tests'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "testslist") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Tests List</button></a></div>
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/createTest'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createtests") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Add a Test</button></a></div>
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/assignTest'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "assigntest") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Assigned Tests</button></a></div>
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/createassignTest'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createassigntest") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Assigned New Test</button></a></div>
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/testQuestions'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "uploadqtns") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Test Questions</button></a></div>
        <div class="col-xs-2"><a style="color:#FFF;" href="<?php echo Yii::app()->request->baseUrl . '/admin/createTestQuestions'; ?>"><button class="<?php if (Yii::app()->user->getState("adminsubmenu") == "createqtns") { ?>btn btn-primary<?php }else { ?> btn btn-default <?php } ?>">Upload Bulk Questions</button></a></div>
             
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12">
                
        <div class="col-xs-12"> 
            <div class="row">
                <div class="col-xs-8">
                    <h4 id="courseHeading"><b>Tests List</b></h4>
                </div>
                <div class="col-xs-4">
                    <!--<a id="courseBttn" class="btn btn-primary pull-right" href="<?php echo Yii::app()->request->baseUrl . '/admin/createTest'; ?>" >Add New Test</a>-->
                </div>
            </div>
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
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <table class="table table-responsiv table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Question</th>
                                    <th>Option1</th>
                                    <th>Option2</th>
                                    <th>Option3</th>
                                    <th>Option4</th>
                                    <th>Answer</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                                if (isset($models) && !empty($models)) {
                                     $i=1;
                                    foreach ($models as $model) {
                                        ?>
                                        <tr id="record<?php echo $model['id']; ?>" <?php if(($i%2)==0) { ?>class="info" <?php } ?>>
                                            <td>
                                                <?php echo Courses::model()->getCourseName($model['course_id']); ?>
                                            </td>                                            
                                            <td>
                                                <?php echo $model['question']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['option1']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['option2']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['option3']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['option4']; ?>  
                                            </td>
                                            <td>
                                                <?php echo $model['answer']; ?>  
                                            </td>
                                        </tr>
                                    <?php $i++;}
                                } else { ?>
                                <div class="alert alert-info fade in">
                                    <strong>Oops!</strong> Currently there are no Questions Uploaded Upto Now.
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
        </div>
    </div>
</div>
<script>
        
    function deleteRecord(recordId){
        var message = confirm("Are You Sure!\n That You want to delete Record.");
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";           
        if (message == true) {                   
            jQuery.ajax({                            
                url: baseurl+'/admin/deleteTest',
                type: "POST",
                data: {id: recordId},  
                error: function(){
                    alert("Something Went Wrong...Please Try Later.");
                },
                success: function(resp){                   
                    if(resp=="success"){
                        document.getElementById('record'+recordId).style.display = "none";
                    }else{
                        alert("Something Went Wrong...Please Try Later.");
                    }
                }
            });
        } else {
            alert("Ok. You Have Cancelled The Deletion.");
        }
            
    }
    function makeStatusRecord(recordId,status){
        var message = confirm("Are You Sure!\n That You want to Update Status.");
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
        var currentstatus = document.getElementById('hiddenmakestatus'+recordId).value;           
        if (message == true) {                   
            jQuery.ajax({                            
                url: baseurl+'/admin/MakeStatusTest',
                type: "POST",
                data: {id: recordId},  
                error: function(){
                    alert("Something Went Wrong...Please Try Later.");
                },
                success: function(resp){                   
                    if(resp=="success"){
                        if(currentstatus=="1"){
                            $('#status'+recordId).removeClass('label-success');  
                            $('#status'+recordId).addClass('label-warning');  
                            document.getElementById('status'+recordId).innerHTML = "InActive";
                            $('#makestatus'+recordId).removeClass('label-warning');  
                            $('#makestatus'+recordId).addClass('label-success'); 
                            document.getElementById('makestatus'+recordId).innerHTML = "Make Active";
                            document.getElementById('hiddenmakestatus'+recordId).value = "0";
                        }else{             
                            $('#status'+recordId).removeClass('label-warning');  
                            $('#status'+recordId).addClass('label-success');  
                            document.getElementById('status'+recordId).innerHTML = "Active";
                            $('#makestatus'+recordId).removeClass('label-success');  
                            $('#makestatus'+recordId).addClass('label-warning'); 
                            document.getElementById('makestatus'+recordId).innerHTML = "Make InActive";
                            document.getElementById('hiddenmakestatus'+recordId).value = "1"; 
                        }
                    }else{
                        alert("Something Went Wrong...Please Try Later.");
                    }
                }
            });
        } else {
            alert("Ok. You Have Cancelled The Deletion.");
        }
            
    }
</script>
<?php $this->renderPartial('//layouts/footer'); ?>