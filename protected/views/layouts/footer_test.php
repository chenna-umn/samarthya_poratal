<!--   ---------------------- Start Footer Page Content -----------------------    -->

<div class="container" style="background: #fff;" >
   <hr class="featurette-divider footerdivider">
   <div class="col-xs-12 col-md-7">
   <ul class="nav navbar-nav footer-menu">
       <?php if((isset(Yii::app()->user->memId) && !empty(Yii::app()->user->memId)) ||(isset(Yii::app()->user->userId) && !empty(Yii::app()->user->userId))) { ?>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Home</a></li>
      <li>|</li>      
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Courses</a></li>      
      <li>|</li>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Contact Us</a></li>  
      <?php } else { ?>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Home</a></li>
      <li>|</li>      
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Courses</a></li>
      <li>|</li>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Login</a></li>
      <li>|</li>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Sign Up</a></li>
      <li>|</li>
      <li class="active"><a href="javascript:void(0);" onclick="showAlert();">Contact Us</a></li>
      <?php } ?>
   </ul>
   </div>
   <div class="col-xs-12 col-md-5">
      <ul class="nav navbar-nav social-menu">
      <li class="followus">Follow Us</li>
      <li><a href="javascript:void(0);" onclick="showAlert();"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/facebook-icon.png" /></a></li>
      <li><a href="javascript:void(0);" onclick="showAlert();"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/twitter-icon.png" /></a></li>
      <li><a href="javascript:void(0);" onclick="showAlert();"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/pinterest-icon.png" /></a></li>
      <li><a href="javascript:void(0);" onclick="showAlert();"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/flickr-icon.png" /></a></li>
      <li><a href="javascript:void(0);" onclick="showAlert();"><img src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/youtube-icon.png" /></a></li>
      </ul>
   </div>
</div>
<footer><div class="container " style="padding-left: 15px; padding-right: 15px;">
        <p class="pull-left">Copyrights &copy; NIRD, Hyderabad- 2015. All Rights Reserved.</p>
        <p class="pull-right" style="font-size: 12px;">Designed & Developed by: Code and Pixels Interactive Technologies PVT. LTD.</p>
    </div></footer>
<!--   ---------------------- End Footer Page Content -----------------------    -->

  </div> 
 
</body>
</html>