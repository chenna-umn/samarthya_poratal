<!--   ----------------------  Start  Header Content -----------------------    -->
<div class="container" style="background: #ffffff;">    
    <div class="img-responsive center-block pull-left" style="margin-top: 15px;"><img class="img-responsive center-block" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/samarthya-logo.jpg" alt="samarthya" /></div>
    <div class="img-responsive center-block pull-right"><img class="img-responsive center-block" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/emblem-img.jpg" alt="Indian Emblem" /></div>
</div>
<!--   ---------------------- End  Header Content -----------------------    -->

<!--   ---------------------- Start  Navigation -----------------------    -->

<nav class="navbar navbar-default">
   <div class="container">   
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
                <li class="<?php if (Yii::app()->user->getState("menu") == "home") { ?>active <?php } ?>">
                    <?php if (isset(Yii::app()->user->memId)) { ?>
                        <a href="javascript:void(0);" onclick="showAlert();">Home</a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" onclick="showAlert();">Home</a>
                    <?php } ?>
                </li>
                <?php if (isset(Yii::app()->user->memId)) { ?>
                <li class="<?php if (Yii::app()->user->getState("menu") == "testResults") { ?>active <?php } ?>" ><a href="javascript:void(0);" onclick="showAlert();">Test Results</a></li>
                <li class="<?php if (Yii::app()->user->getState("menu") == "visitedcourse") { ?>active <?php } ?>" ><a href="javascript:void(0);" onclick="showAlert();">Visited Courses</a></li>
                <?php }else { ?>                
                <li class="<?php if (Yii::app()->user->getState("menu") == "reports") { ?>active <?php } ?>" ><a href="javascript:void(0);" onclick="showAlert();">Reports</a></li>
                <?php } ?>
            </ul>
         
          <?php if(isset(Yii::app()->user->memname)) { ?>
          <ul class="nav navbar-nav navbar-right right-margin">
         <li class="user-info">Welcome  <span class="user-name" style="color:orange;font-weight: bold;"><?php if(isset(Yii::app()->user->firstname)) { echo Yii::app()->user->firstname; }?></span></li>
         <li><a href="javascript:void(0);" onclick="showAlert();">Logout</a></li>
            <li class="active dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon-cog"></span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" onclick="showAlert();">Change Password</a></li>
                    </ul>
                </li>
                <li class="" id="imageupload"><a href="#" style="padding-top: 10px; padding-bottom: 10px;"  data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php
                            $user = User::model()->findByPk(Yii::app()->user->memId);
                            if(isset($user->profilePic) && !empty($user->profilePic)){
                                $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/'.$user->profilePic;
                            }else{
                                $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/user.jpg';
                            }
                        ?>
                        
                        <img src="<?php echo $profilePic;?>" style="width: 30px; height: 30px;">
                    </a>
                    
                </li>
         </ul>
          <?php } ?>
         <!--<ul class="nav navbar-nav navbar-right">
            <li><a href="#">Sign Up</a></li>
         </ul>-->
      </div>
   </div>
</nav>
<div id="myModal12" class="modal fade" data-backdrop="static" style="background-color: rgba(250,250, 250, 0.5);">
    <div class="modal-dialog" style="top : 25%;">
        <div class="modal-content">
            <div class="modal-header" style="background: #f1f1f1;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:red;">&times;</button>
                <h4 class="modal-title">Hi...<?php echo Yii::app()->user->firstname; ?></h4>
            </div>
            <div class="modal-body">
                <span id="message2"></span>

            </div>
            <div class="modal-footer" style="background: #f1f1f1;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                
            </div>
        </div>
    </div>
</div>
<script>
    function showAlert(){
        document.getElementById("message2").innerHTML='You Are Not Allowed to Perform this action.Please Complete Test.';
                $('#myModal12').modal('show');
//        alert("You Are Not Allowed to Perform this action.Please Complete Test.");
    }
</script>