<div class="container" style="background: #FFFFFF;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Courses</h3>
        <hr class="featurette-divider">
        <p>Human, Livestock population and other living beings depend on natural resources for their different 

            requirements in both space and time. Natural resources like land, water and vegetation are limited and 

            inadequate to meet the growing requirements of different categories of living beings. In order to meet 

            such requirements, judicious and optimal utilization of natural resources is the need of the hour. For 

            development and management of such natural resources to meet growing requirements of different 

            categories of living beings, Government of India have designed and launched several programmes since 

            independence. However, these programmes were not utilized to the extent desired due to various factors 

            like lack of awareness among primary and secondary stakeholders, inadequate people’s participation, 

            deficiencies in capacity and training programmes designed to field staff, lack of interest among PRIs for 

            involvement and in the process lot of money invested and the results could not be properly quantified...<a href="<?php echo Yii::app()->request->baseUrl . '/site/Download?name=Content_about_all_courses.pdf&path=uploads/coursePDF'; ?>">Read More...</a></p>
        <br/>        
    </div>
</div>
<!--   ---------------------- Start Details Page video Content -----------------------    -->

<div class="container" style="background: #FFFFFF;">

    <?php
    if (isset($courses) && !empty($courses)) {
        foreach ($courses as $key => $value) {
            ?>

            <div class="col-xs-12 col-xs-6 col-md-3" style="margin-bottom: 10px;">
                <div class="course-box">
                    <div class="course-header"><h5 class="course-title">Course <?php echo $value->courseNumber; ?></h5></div>
                    <div align="center" class="course-img img-responsive" ><img  src="<?php echo Yii::app()->request->baseUrl . '/uploads/courseImages/' . $value->courseImage; ?>" />
                    </div>
                    <div class="course-footer"><a href="<?php echo Yii::app()->request->baseUrl . '/site/courses'; ?>"><?php echo $value->courseName; ?><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/course-arrow.png" class="pull-right" /></a></div>
                </div>   
            </div>


        <?php }
    } else {
        ?>
        <div class="row margin-bottom-10">
            <div class="info1 alert alert-warning fade in">
                <strong>  Oops... There are No Courses Available Currently...</strong>
            </div>
        </div>
    <?php } ?>
</div>
<?php $this->renderPartial('//layouts/footer'); ?>