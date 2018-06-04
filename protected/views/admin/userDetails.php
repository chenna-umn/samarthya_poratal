<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">User Details</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12">
        <div class="col-xs-12">
        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/ExportuserDetails';?>">
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
                $distinctDesignation = User::model()->getDistinctDesignationAll();
                $distinctStates = User::model()->getDistinctStatesAll();                
                ?>
                <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="panel panel-default">
                        <table class="table table-responsiv table-bordered">
                            <thead>
                                <tr>
                                    <th>User Name</th>                                    
                                    <th>
                                        <select required name="userId" class="form-control" onchange="searchByDesignationsUserDetails(this.value);">
                                            <option value="All" selected <?php if (isset($designationId) && ($designationId == "All")) { ?> selected <?php } ?>>Designations</option>
                                            <?php
                                            if (isset($distinctDesignation) && !empty($distinctDesignation)) {
                                                foreach ($distinctDesignation as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['functionary_name'] ?>" <?php if (isset($designationId) && ($designationId == $value['functionary_name'])) { ?> selected <?php } ?>><?php echo $value['functionary_name'] ?></option>                                
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <select required name="userId" class="form-control" onchange="searchByStateUserDetails(this.value);">
                                            <option value="All" selected <?php if (isset($stateId) && ($stateId == "All")) { ?> selected <?php } ?>>States</option>
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
                                    <th>Staff Id</th>
                                    <th>Mobile Number</th>                                                                       
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
                                                <?php echo $model['username']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['functionary_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['state']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['staffid']; ?>
                                            </td>
                                            <td>
                                                <?php echo $model['mobile']; ?>
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
           
        </div>
    </div>
</div>
<script>
    function searchByDesignationsUserDetails(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByDesignationsReportsUserDetails?id='+id;
        window.location = url;
        window.location.replace (url)
    }
    function searchByStateUserDetails(id){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        var url = baseurl+'/admin/searchByStateReportsUserDetails?id='+id;
        window.location = url;
        window.location.replace (url)
    }    
</script>
<?php $this->renderPartial('//layouts/footer'); ?>