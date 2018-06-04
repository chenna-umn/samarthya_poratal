<!--   ---------------------- Start Footer Page Content -----------------------    -->

<div class="container" style="background: #fff;" >
   <hr class="featurette-divider footerdivider">
   <div class="col-xs-12 col-md-7">
   <ul class="nav navbar-nav footer-menu">
       <?php if((isset(Yii::app()->user->memId) && !empty(Yii::app()->user->memId)) ||(isset(Yii::app()->user->userId) && !empty(Yii::app()->user->userId))) { ?>
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" >Home</a></li>
      <li>|</li>      
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/courses';?>" >Courses</a></li>      
      <li>|</li>
      <li class="active"><a href="javascript:void(0);" >Contact Us</a></li>  
      <?php } else { ?>
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" >Home</a></li>
      <li>|</li>      
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/courses';?>" >Courses</a></li>
      <li>|</li>
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" >Login</a></li>
      <li>|</li>
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" >Sign Up</a></li>
      <li>|</li>
      <li class="active"><a href="<?php echo Yii::app()->request->baseUrl.'/site/contactUs';?>" >Contact Us</a></li>
      <?php } ?>
   </ul>
   </div>
   <div class="col-xs-12 col-md-5">
      <ul class="nav navbar-nav social-menu">
      <li class="followus">Follow Us</li>
      <li><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/facebook-icon.png" /></a></li>
      <li><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/twitter-icon.png" /></a></li>
      <li><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/pinterest-icon.png" /></a></li>
      <li><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/flickr-icon.png" /></a></li>
      <li><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/youtube-icon.png" /></a></li>
      </ul>
   </div>
</div>
<footer><div class="container " style="padding: 15px;padding-top: 20px;">
        <p class="pull-left" style="margin-bottom: 0px;">Copyrights &copy; NIRD, Hyderabad- 2015. All Rights Reserved.</p>
        <p class="pull-right" style="font-size: 12px;margin-bottom: 0px;">Designed & Developed by: Code and Pixels Interactive Technologies PVT. LTD.</p>
    </div></footer>
<!--   ---------------------- End Footer Page Content -----------------------    -->

  </div> 
  <a href="#" class="back-to-top" style="display: inline;">
<i class="fa fa-arrow-circle-up"></i>
</a>
</body>
</html>