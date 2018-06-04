<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">View Certificate</h3>
    </div>
</div>
<div class="container" style="background: #ffffff;">
    <div id="course-container" class="col-xs-12">              
        <?php
        $msg = '<div style="width:800px; height:580px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:750px; height:530px; padding:20px; text-align:center; border: 5px solid #787878">
    <div class="row">
            <img src="'.Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" />
             <img src="'.Yii::app()->request->baseUrl . '/sm_assets/assets/images/emblem-img.jpg" />
    <div>
    <div class="row" style="margin-right:20px;">        
           <p style="text-align:right;">Certificate Id : XXXXXXXXXXXXXXX</p>            
    <div>
    <span style="font-size:50px; font-weight:bold">Certificate of Completion</span
    <br><br>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br><br>
       <span style="font-size:30px"><b>' . $user->username . '</b></span><br/><br/>
       <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
       <span style="font-size:30px">' . $course->courseName . '</span> <br/><br/>
       <span style="font-size:20px">with score of <b>' . $postTestScore['obtained_marks'] . '/' . $postTestScore['total_marks'] . '</b></span> <br/><br/>
      
      
       <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Minister of Rural Development</span> <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Secretary (MoRD)</span> 
       <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Join-Secretary (MoRD)</span><br/><br/>
       </div>
</div>';

        echo $msg;
        ?>
    </div>
</div>
</div>
</div>
<?php $this->renderPartial('//layouts/footer'); ?>

