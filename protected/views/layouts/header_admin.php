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
                <li class="<?php if (Yii::app()->user->getState("adminmenu") == "userdetails") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/userDetails'; ?>">User Details</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminmenu") == "usertestdetails") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/reports'; ?>">Test Results</a></li>
                <li class="<?php if ((Yii::app()->user->getState("adminmenu") == "logindetails") || Yii::app()->user->getState("adminmenu") == "visitedcourse") { ?>active <?php } ?>"class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"></span>History<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php if (Yii::app()->user->getState("adminmenu") == "logindetails") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/loginHistory'; ?>">Login History</a></li>
                        <li class="<?php if (Yii::app()->user->getState("adminmenu") == "visitedcourse") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/visitedCourse'; ?>">Visited Course</a></li>
                    </ul>
                </li>

<!--                <li class="<?php if (Yii::app()->user->getState("adminmenu") == "course") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/index'; ?>">Courses</a></li>
                <li class="<?php if (Yii::app()->user->getState("adminmenu") == "tests") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/tests'; ?>">Test Details</a></li>-->
                <li class="<?php if ((Yii::app()->user->getState("adminmenu") == "certificate") || Yii::app()->user->getState("adminmenu") == "gencertificate" || Yii::app()->user->getState("adminmenu") == "valicertificate") { ?>active <?php } ?>"class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"></span>Certificate<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="<?php if (Yii::app()->user->getState("adminmenu") == "certificate") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/validateCertificate'; ?>">Generate Certificate</a></li> 
                        <li class="<?php if (Yii::app()->user->getState("adminmenu") == "gencertificate") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/generatedCertificate'; ?>">Certificates Generated</a></li>
                        <li class="<?php if (Yii::app()->user->getState("adminmenu") == "valicertificate") { ?>active <?php } ?>"><a href="<?php echo Yii::app()->request->baseUrl . '/admin/checkCertificate'; ?>">Validate Certificate</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right right-margin">
                <li class="user-info">Welcome  <span class="user-name" style="color:orange;font-weight: bold;"><?php if (isset(Yii::app()->user->username)) {
    echo Yii::app()->user->firstname;
} ?></span></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl . '/site/logout'; ?>">Logout</a></li>
                <li class="" id="imageupload"><a href="#" style="padding-top: 10px; padding-bottom: 10px;"  data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php
                        $user = User::model()->findByPk(Yii::app()->user->userId);
                        if (isset($user->profilePic) && !empty($user->profilePic)) {
                            $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/' . $user->profilePic;
                        } else {
                            $profilePic = Yii::app()->request->baseUrl . '/uploads/profilePic/user.jpg';
                        }
                        ?>

                        <img src="<?php echo $profilePic; ?>" style="width: 30px; height: 30px;">
                    </a>
                    <ul class="dropdown-menu" role="" style="padding-left: 15px;">
                        <li class="" style="width: 200px;">

                            <!-- Update Password -->
                            <div id="updatePwd" style="width: 200px;">
                                <img class="img-responsive"src="<?php echo $profilePic; ?>" style="width: 100px; height: 100px;">
                                <form action="<?php echo Yii::app()->request->baseUrl . '/site/uploadProfilePic' ?>" method="post" enctype="multipart/form-data" style="width: 200px;" >
                                    <div  id="label" style="width: 200px;">   
                                        <input type="file" class="pull-left" name="profilePic" id="profilePic" style="width: 100%;" onchange="selectimage()"> 
                                        <br/><br/>
                                        <input type="submit" class="btn btn-success" value="Upload" name="submit"/>
                                    </div><br/>

                                </form>
                            </div>

                        </li>
                    </ul>
                </li>
            </ul>
            <!--<ul class="nav navbar-nav navbar-right">
               <li><a href="#">Sign Up</a></li>
            </ul>-->
        </div>
    </div>
</nav>