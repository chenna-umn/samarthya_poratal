<?php

class SiteController extends Controller {

//	public $layout='mainv';
    public $defaultAction = 'index';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        Yii::app()->user->setState("menu", "home");
        if (isset(Yii::app()->user->memId)) {
            $this->redirect('site/landing');
        } else if (isset(Yii::app()->user->userId)) {
            $this->redirect(array('admin/index'));
        } else {
            ini_set('max_execution_time', 300);
            $this->layout = '//layouts/main';
            $this->render('index');
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else {
                echo "<pre>";
                print_r($error);
            }
//                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->login()) {
                $loginHistoryModel = new Loginhistory();

                if (Yii::app()->user->userType == 1) {
                    $this->redirect(array('admin/userDetails'));
                } else if (Yii::app()->user->userType == 2) {
                    $loginHistoryModel->user_id = Yii::app()->user->memId;
                    $loginHistoryModel->login_time = date('Y-m-d h:i:s');
                    if ($loginHistoryModel->validate()) {
                        if ($loginHistoryModel->save()) {
                            Yii::app()->user->setState('login_time', $loginHistoryModel->login_time);
                            Yii::app()->user->setState('login_time_id', $loginHistoryModel->id);
                            if ($loginHistoryModel->validate()) {
                                if ($loginHistoryModel->save()) {
                                    
                                }
                            }
                        }
                    }
                    $this->redirect(array('site/landing'));
                }
            } else {
                Yii::app()->user->setFlash('loginfailed', "Please Provide valid Username / Password...!");
                $this->layout = '//layouts/main';
                $this->render('index');
            }
        }
    }

    public function actionloginForm() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->login()) {
                $loginHistoryModel = new Loginhistory();

                if (Yii::app()->user->userType == 1) {
                    $this->redirect(array('admin/userDetails'));
                } else if (Yii::app()->user->userType == 2) {
                    $loginHistoryModel->user_id = Yii::app()->user->memId;
                    $loginHistoryModel->login_time = date('Y-m-d h:i:s');
                    if ($loginHistoryModel->validate()) {
                        if ($loginHistoryModel->save()) {
                            Yii::app()->user->setState('login_time', $loginHistoryModel->login_time);
                            Yii::app()->user->setState('login_time_id', $loginHistoryModel->id);
                            if ($loginHistoryModel->validate()) {
                                if ($loginHistoryModel->save()) {
                                    
                                }
                            }
                        }
                    }
                    $this->redirect(array('site/landing'));
                }
            } else {
                Yii::app()->user->setFlash('error', "Please Provide valid Username / Password...!");
                $this->layout = '//layouts/main';
                $this->render('LoginForm');
            }
        } else {
            $this->layout = '//layouts/main';
            $this->render('LoginForm');
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {

        $this->layout = '//layouts/main';
        if (Yii::app()->user->hasState('login_time_id')) {
            $loginHistoryModel = Loginhistory::model()->findByPk(Yii::app()->user->getState('login_time_id'));
            $loginHistoryModel->logout_time = date('Y-m-d h:i:s');
            $loginHistoryModel->logout_comment = "Successfully LoggedOut";
            if ($loginHistoryModel->validate()) {
                if ($loginHistoryModel->save()) {
                    
                }
            }
        }
        Yii::app()->user->logout();
        $this->redirect('index');

        //$this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegister() {

        if (isset($_POST['email']) && isset($_POST['staffid']) && isset($_POST['designation'])) {

            $user = new User();
            $user->username = $_POST['username'];
            $user->password = md5($_POST['password']);
            $user->user_type = 2;
            $user->created_on = date('Y-m-d h:i:s');
            $user->updated_on = date('Y-m-d h:i:s');
            $user->status = 1;
            $user->email = $_POST['email'];
            $user->staffid = $_POST['staffid'];
            $user->designation = $_POST['designation'];
            $user->state_code = $_POST['state'];
            $user->state = State::model()->getStateName($_POST['state']);
            $user->mobile = $_POST['mobile'];
            $user->adhaar = $_POST['adhaar'];
            $user->activation_link = md5($_POST['email']);
            $user->functionary_name = $_POST['firstname'];
             $user->staff_name = $_POST['staffname'];           
            if ($user->validate()) {
                if ($user->save()) {
                    
                    $fields_string = '';
                    $url = 'http://164.100.129.6/netnrega/nrega_nird_olp.svc/ConfirmRegistration';
                    $fields = array(
                        'state_code' => urlencode($user->state_code),
                        'staff_id' => urlencode($user->staffid),
                        'olp_register_date' => urlencode(date('d/m/Y',strtotime($user->created_on)))
                    );

//url-ify the data for the POST
                    foreach ($fields as $key => $value) {
                        $fields_string .= $key . '=' . $value . '&';
                    }
                    rtrim($fields_string, '&');
//open connection
                    $ch = curl_init();
//set the url, number of POST vars, POST data
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, count($fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute post
                    $result = curl_exec($ch);
//close connection
                    curl_close($ch);
                    $results = json_decode($result, true);
                    
//                    echo $fields_string;                  
//                    print_r($results);exit;
                    $msg="Olp username :".$_POST['username']." Password :".$_POST['password'];
                    $mobile=$_REQUEST['mobile'];
                    $url1=Yii::app()->params['smsSiteUrl'].'?userid='.Yii::app()->params['smsUserId'].'&pass='.Yii::app()->params['smsUserPass'].'&phone='.$mobile.'&msg='.urlencode($msg).'&title='.Yii::app()->params['smstitle'];
//                     echo $url1;exit;
                    $url = 'http://www.siegsms.com/SendingSms.aspx?userid=digitalteacher&pass=digiteacher@123&phone=8106909332&msg=8099&title=DGTCHR';
                    // create a new cURL resource
                    $curl = curl_init();
                    // set URL and other appropriate options
                    curl_setopt($curl, CURLOPT_URL, $url1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    // grab URL and pass it to the browser
                    if (curl_exec($curl)) {
                        
                    } else {
                        
                    }
                    if (curl_errno($curl)) {
                        print curl_error($curl);
                    } else {
                        curl_close($curl);
                    }
                    require_once('sm_assets/mailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer();
                    //$body             = file_get_contents('contents.html');
                    $body = '<!-- 
                                                                                     * Template Name: Unify - Responsive Bootstrap Template
                                                                                     * Description: Business, Corporate, Portfolio and Blog Theme.
                                                                                     * Version: 1.6
                                                                                     * Author: @htmlstream
                                                                                     * Website: http://htmlstream.com
                                                                                     -->
                                                                                    <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Member Registration Confirmation</title>

                                                                                    <style type="text/css">
                                                                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                                                                        .ExternalClass {width: 100%; background-color: #ffffff;}
                                                                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                                                                        table {border-collapse: collapse;}

                                                                                        @media only screen and (max-width: 640px)  {
                                                                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                                                                        body[yahoo] .center {text-align: center!important;}  
                                                                                                }

                                                                                        @media only screen and (max-width: 479px) {
                                                                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                                                                        body[yahoo] .center {text-align: center!important;}  
                                                                                                }
                                                                                    </style>
                                                                                    </head>
                                                                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                                                                    <!-- Wrapper -->
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
                                                                                        <tr>
                                                                                            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                                                                <!--Start Header-->
                                                                                                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                                    <tr>
                                                                                                        <td style="padding: 6px 0px 0px">
                                                                                                            <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                                                <tr>
                                                                                                                    <td width="100%" >
                                                                                                                        <!--Start logo-->
                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                                            <tr>
                                                                                                                                <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                                                                    <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </table><!--End logo-->
                                                                                                                        <!--Start nav-->
                                                                                                                        <!--End nav-->
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                </table> 
                                                                                                <!--End Header-->

                                                                                                <!-- Start Headliner-->                                                                                       

                                                                                                <div style="height:15px">&nbsp;</div><!-- divider -->

                                                                                                <!--Start Discount -->
                                                                                                <table width="700" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                    <tr>
                                                                                                        <td width="100%" bgcolor="#ffffff">
                                                                                                            <!-- Left Box  -->
                                                                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                                <tr>
                                                                                                                    <td class="center">
                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left"> 
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Dear , ' . $_POST['email'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    User Name : , ' . $_POST['username'] . ',.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Password : , ' . $_POST['password'] . ',.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For Registering with us.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Best of luck,<br>
                                                                                                                                    Team OLP<br>
                                                                                                                                    <br>
                                                                                                                               </td>
                                                                                                                            </tr>                                                                                                               
                                                                                                                        </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table><!--End Left Box-->

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>       



                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>                                                                                       

                                                                                            </td>
                                                                                        </tr>
                                                                                    </table> 
                                                                                    <!-- End Wrapper -->
                                                                                    </body>
                                                                                    </html>';
                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                    //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                    $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                    //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                    $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                    $mail->Password = Yii::app()->params['emailPassword'];
                    $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                    $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                    $mail->Subject = "OLP Detaits";
                    //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                    $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                    $mail->Port = 587;
                    $address = $user->email;
                    $mail->AddAddress($address, $user->email);
                    //$mail->SMTPDebug  = 1;     
                    $mail->isHTML(true);
                    if (!$mail->Send()) {
                        echo "fail";
                    } else {
                        echo "registered";
                    }
                } else {
                    echo "fail";
                }
            }
        }
    }

    public function actionLanding() {
        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        if (isset(Yii::app()->user->memId)) {
            Yii::app()->user->setState("menu", "home");
            $courses = Courses::model()->findAll('status=:status ORDER BY order_by', array('status' => 1));
            $this->render('userlanding', array('courses' => $courses));
        } else {
            $this->render('index');
        }
    }

    public function actionCourses() {
        ini_set('max_execution_time', 300);
        Yii::app()->user->setState("menu", "home");
        $this->layout = '//layouts/courses';
        $courses = Courses::model()->findAll('status=:status ORDER BY order_by', array('status' => 1));
        $this->render('courses', array('courses' => $courses));
    }

    public function actionDetails($id) {
        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        if (isset(Yii::app()->user->memId)) {
            Yii::app()->user->setState("menu", "home");
            $courses = Courses::model()->findByPk($id);
            $courseDetails = Coursedetails::model()->findAll('courseId=:courseId AND status=:status ORDER BY order_by', array('status' => 1, 'courseId' => $id));
            $this->render('courseDetails', array('courseDetails' => $courseDetails, 'courses' => $courses));
        } else {
            $this->render('index');
        }
    }

    public function actionModules($id) {
        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        if (isset(Yii::app()->user->memId)) {
            Yii::app()->user->setState("menu", "home");
            $courses = Courses::model()->findByPk($id);
            $courseDetails = Coursedetails::model()->findAll('courseId=:courseId AND status=:status ORDER BY order_by', array('status' => 1, 'courseId' => $id));
            $this->render('courseModules', array('courseDetails' => $courseDetails, 'courses' => $courses));
        } else {
            $this->render('index');
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actioncheckemail() {

        if (isset($_POST['email'])) {
            $model = User::model()->find('email=:email', array(':email' => $_POST['email']));
            if (isset($model) && !empty($model)) {
                echo "registered";
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    public function actionForgotPassword() {


        if (isset($_POST['email'])) {
            
            $user = User::model()->find('email=:email', array(strtolower($_POST['email'])));
           
            if (isset($user) && !empty($user)) {
                require_once('sm_assets/mailer/PHPMailerAutoload.php');
                $mail = new PHPMailer();
                $body = '<!-- 
                                 * Template Name: Unify - Responsive Bootstrap Template
                                 * Description: Business, Corporate, Portfolio and Blog Theme.
                                 * Version: 1.6
                                 * Author: @htmlstream
                                 * Website: http://htmlstream.com
                                 -->
                                <!doctype html>
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>OLP Forgot Password</title>

                                <style type="text/css">
                                    .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                    .ExternalClass {width: 100%; background-color: #ffffff;}
                                    body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                    table {border-collapse: collapse;}

                                    @media only screen and (max-width: 640px)  {
                                                    body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                    body[yahoo] .center {text-align: center!important;}  
                                            }

                                    @media only screen and (max-width: 479px) {
                                                    body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                    body[yahoo] .center {text-align: center!important;}  
                                            }
                                </style>
                                </head>
                                <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                <!-- Wrapper -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tr>
                                        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                            <!--Start Header-->
                                            <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                <tr>
                                                    <td style="padding: 6px 0px 0px">
                                                        <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                            <tr>
                                                                <td width="100%" >
                                                                    <!--Start logo-->
                                                                    <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                        <tr>
                                                                            <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                            </td>
                                                                        </tr>
                                                                    </table><!--End logo-->
                                                                    <!--Start nav-->
                                                                    <!--End nav-->
                                                                </td>
                                                            </tr>
                                                        </table>
                                                   </td>
                                                </tr>
                                            </table> 
                                            <!--End Header-->

                                            <!-- Start Headliner-->                                                                                       

                                            <div style="height:15px">&nbsp;</div><!-- divider -->

                                            <!--Start Discount -->
                                            <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                <tr>
                                                    <td width="100%" bgcolor="#ffffff">
                                                        <!-- Left Box  -->
                                                        <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                            <tr>
                                                                <td class="center">
                                                                    <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                        <tr>
                                                                            <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Dear , ' . $user->username . ' ,                            
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Please click on the following link to reset your password:                        
                                                                           </td>
                                                                        </tr>  
                                                                         <tr>
                                                                                <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                        <a href="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->email) . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Reset Password</a>
                                                                                    </td>                                                                                                                    
                                                                            </tr> 
                                                                            <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        In case the above link does not work, copy and paste the following URL onto the address bar of your browser.
                                                                                   </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        <a href="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->email) . '">' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->email) . '</a>                         
                                                                                   </td>
                                                                                </tr>                                                                                                                                                            
                                                                                 
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>       



                                                    </td>
                                                </tr>
                                            </table>                                                                                       

                                        </td>
                                    </tr>
                                </table> 
                                <!-- End Wrapper -->
                                </body>
                                </html>';


                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                $mail->SMTPAuth = true;                  // enable SMTP authentication
                $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                $mail->Password = Yii::app()->params['emailPassword'];
                $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                $mail->Subject = "OLP Detaits";
                //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                $mail->Port = 587;
                $address = $user->email;
                $mail->AddAddress($address, $user->email);
                $mail->isHTML(true);
                if (!$mail->Send()) {
                    echo "fail";
                } else {
                    echo "sent";
                }
            } else {
                echo "notset";
            }
        } else {
            echo "notset";
        }
    }

    public function actionUpdatePassword() {

        $this->layout = '//layouts/main';

        if (isset($_GET['link']) && $_GET['mail']) {
            $checkUser = User::model()->find('activation_link=:activation_link', array(':activation_link' => $_GET['link']));
            if (isset($checkUser) && !empty($checkUser)) {
                if (md5($checkUser->username) == $_GET['mail']) {
                    $this->render('updatepassword', array('activation_link' => $_GET['link']));
                } else {
                    Yii::app()->user->setFlash('error', "You are not Authorized to Activate account..Please Try Later...!");
                    $this->render('forgotpassword');
                }
            } else {
                Yii::app()->user->setFlash('error', "Reset Password  Link is Not Valid");
                $this->render('forgotpassword');
            }
        }
    }

    public function actionUpdatePasswordConfirm() {

        $this->layout = '//layouts/main';
        if (isset($_POST['password']) && $_POST['Confirmpassword']) {

            $checkUser = User::model()->find('activation_link=:activation_link', array(':activation_link' => $_POST['link']));
            if (isset($checkUser) && !empty($checkUser)) {
                $checkUser->password = md5($_POST['password']);
                if ($checkUser->validate()) {
                    if ($checkUser->save()) {

                        require_once('sm_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        $body = '<!-- 
                                                         * Template Name: Unify - Responsive Bootstrap Template
                                                         * Description: Business, Corporate, Portfolio and Blog Theme.
                                                         * Version: 1.6
                                                         * Author: @htmlstream
                                                         * Website: http://htmlstream.com
                                                         -->
                                                        <!doctype html>
                                                        <html xmlns="http://www.w3.org/1999/xhtml">
                                                        <head>
                                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                        <title>Job Portal Password Updated</title>

                                                        <style type="text/css">
                                                            .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                                            .ExternalClass {width: 100%; background-color: #ffffff;}
                                                            body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                                            table {border-collapse: collapse;}

                                                            @media only screen and (max-width: 640px)  {
                                                                            body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }

                                                            @media only screen and (max-width: 479px) {
                                                                            body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }
                                                        </style>
                                                        </head>
                                                        <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                                        <!-- Wrapper -->
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                                    <!--Start Header-->
                                                                    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td style="padding: 6px 0px 0px">
                                                                                <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td width="100%" >
                                                                                            <!--Start logo-->
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                <tr>
                                                                                                    <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                                        <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table><!--End logo-->
                                                                                            <!--Start nav-->
                                                                                            <!--End nav-->
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                           </td>
                                                                        </tr>
                                                                    </table> 
                                                                    <!--End Header-->

                                                                    <!-- Start Headliner-->                                                                                       

                                                                    <div style="height:15px">&nbsp;</div><!-- divider -->

                                                                    <!--Start Discount -->
                                                                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td width="100%" bgcolor="#ffffff">
                                                                                <!-- Left Box  -->
                                                                                <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td class="center">
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                                                <tr>
                                                                                                    <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Dear , ' . $checkUser->username . '                            
                                                                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td  class="center" style="font-size: 14px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Password Updated Successfully                         
                                                                                                   </td>
                                                                                                </tr>  
                                                                                                                                                                                                                     
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>       



                                                                            </td>
                                                                        </tr>
                                                                    </table>                                                                                       

                                                                </td>
                                                            </tr>
                                                        </table> 
                                                        <!-- End Wrapper -->
                                                        </body>
                                                        </html>';


                        $mail->IsSMTP(); // telling the class to use SMTP
                        $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                        //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                        $mail->SMTPAuth = true;                  // enable SMTP authentication
                        $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                        //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                        $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                        $mail->Password = Yii::app()->params['emailPassword'];
                        $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                        $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                        $mail->Subject = "OLP Detaits";
                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                        $mail->Port = 587;
                        $address = $checkUser->email;
                        $mail->AddAddress($address, $checkUser->email);
                        $mail->isHTML(true);
                        //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                        if (!$mail->Send()) {
                            //  echo "Mailer Error: " . $mail->ErrorInfo;
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Updating Password...Please Try Later...!");
                            $this->render('forgotpassword');
                        } else {
                            Yii::app()->user->setFlash('success', "Password Updated Successfully");
                            $this->render('forgotpassword');
                        }
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', "No user is registered with given email with us. Please Provide valid Email.!");
                $this->render('forgotpassword');
            }
        } else {
            $this->render('forgotpassword');
        }
    }

    public function actionForgotPasswordSendLink() {

        $this->layout = '//layouts/main';
        if (isset($_POST['email'])) {
            $user = User::model()->find('LOWER(email)=?', array(strtolower($_POST['email'])));
            if (isset($user) && !empty($user)) {

                require_once('sm_assets/mailer/PHPMailerAutoload.php');
                $mail = new PHPMailer();
                $body = '<!-- 
                                 * Template Name: Unify - Responsive Bootstrap Template
                                 * Description: Business, Corporate, Portfolio and Blog Theme.
                                 * Version: 1.6
                                 * Author: @htmlstream
                                 * Website: http://htmlstream.com
                                 -->
                                <!doctype html>
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>Job Portal Forgot Password</title>

                                <style type="text/css">
                                    .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                    .ExternalClass {width: 100%; background-color: #ffffff;}
                                    body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                    table {border-collapse: collapse;}

                                    @media only screen and (max-width: 640px)  {
                                                    body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                    body[yahoo] .center {text-align: center!important;}  
                                            }

                                    @media only screen and (max-width: 479px) {
                                                    body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                    body[yahoo] .center {text-align: center!important;}  
                                            }
                                </style>
                                </head>
                                <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                <!-- Wrapper -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tr>
                                        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                            <!--Start Header-->
                                            <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                <tr>
                                                    <td style="padding: 6px 0px 0px">
                                                        <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                            <tr>
                                                                <td width="100%" >
                                                                    <!--Start logo-->
                                                                    <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                        <tr>
                                                                            <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                            </td>
                                                                        </tr>
                                                                    </table><!--End logo-->
                                                                    <!--Start nav-->
                                                                    <!--End nav-->
                                                                </td>
                                                            </tr>
                                                        </table>
                                                   </td>
                                                </tr>
                                            </table> 
                                            <!--End Header-->

                                            <!-- Start Headliner-->                                                                                       

                                            <div style="height:15px">&nbsp;</div><!-- divider -->

                                            <!--Start Discount -->
                                            <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                <tr>
                                                    <td width="100%" bgcolor="#ffffff">
                                                        <!-- Left Box  -->
                                                        <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                            <tr>
                                                                <td class="center">
                                                                    <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                        <tr>
                                                                            <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Dear , ' . $user->username . ' ,                            
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Please click on the following link to reset your password:                        
                                                                           </td>
                                                                        </tr>  
                                                                         <tr>
                                                                                <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                        <a href="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->email) . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Reset Password</a>
                                                                                    </td>                                                                                                                    
                                                                            </tr> 
                                                                            <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        In case the above link does not work, copy and paste the following URL onto the address bar of your browser.
                                                                                   </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        <a href="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->username) . '">' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_link . '&mail=' . md5($user->username) . '</a>                         
                                                                                   </td>
                                                                                </tr>                                                                                
                                                                                
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>       



                                                    </td>
                                                </tr>
                                            </table>                                                                                       

                                        </td>
                                    </tr>
                                </table> 
                                <!-- End Wrapper -->
                                </body>
                                </html>';


                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                $mail->SMTPAuth = true;                  // enable SMTP authentication
                $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                $mail->Password = Yii::app()->params['emailPassword'];
                $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                $mail->Subject = "OLP Detaits";
                //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                $mail->Port = 587;
                $address = $user->email;
                $mail->AddAddress($address, $user->email);
                $mail->isHTML(true);

                //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                if (!$mail->Send()) {

                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Submitting Query...Please Try Later...!");
                } else {

                    Yii::app()->user->setFlash('success', "Reset Password link sent to your mail...Please Proceed further to update Password");
                }
            } else {
                Yii::app()->user->setFlash('error', "No user is registered with given email with us. Please Provide valid Email.!");
            }
            $this->render('forgotpassword');
        } else {
            $this->render('forgotpassword');
        }
    }

    public function actiontakeTest($id) {
        $this->layout = '//layouts/test';
        if (isset(Yii::app()->user->memId)) {
            $assignTestsModel = Assigntests::model()->findByPk($id);
            $testQuestions = Testquestions::model()->getTestQuestions($assignTestsModel->course_id, $assignTestsModel->total_questions, $assignTestsModel->test_id);
            $course = Courses::model()->findByPk($assignTestsModel->course_id);
            $this->render('takeTest', array('testQuestions' => $testQuestions, 'assignTests' => $assignTestsModel, 'course' => $course));
        } else {
            $this->layout = '//layouts/main';
            $this->render('index');
        }
    }

    public function actiontestResult() {
        if (isset(Yii::app()->user->memId)) {
            $this->layout = '//layouts/test';
            $assignTestsModel = Assigntests::model()->findByPk($_POST['assignTestId']);
            if ($assignTestsModel->test_id == 1 || $assignTestsModel->test_id == 3) {
                $testResultsModel = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id', array('course_id' => $assignTestsModel->course_id, 'test_type_id' => $assignTestsModel->test_id, 'user_id' => Yii::app()->user->memId));

                
//                $totalQuestions = $_POST['totalQuestions'];
                $totalQuestions = count($_POST['questions']);
                $totalTime = $assignTestsModel->duration;
                $consumedMin = ($totalTime - $_POST['timeconsumedmin']) - 1;
                $consumedSec = 60 - $_POST['timeconsumedsec'];
                $noOfCorrectAns = 0;
                $testQuestions = '';
                foreach ($_POST['questions'] as $key => $value) {
                    $testQuestions.= $value . ',';
                }
                if (isset($_POST['answers']) && !empty($_POST['answers'])) {
                    foreach ($_POST['answers'] as $key => $value) {
                        if ($value == $_POST['correctAns'][$key]) {
                            $noOfCorrectAns++;
                        }
                    }
                }
                $obtMarks = ceil($noOfCorrectAns * ($assignTestsModel->total_marks / count($_POST['questions'])));
                if ($assignTestsModel->test_id == 2) {
                    if ($obtMarks >= $assignTestsModel->pass_marks) {
                        $result = "Pass";
                        $display = "Passed";
                    } else {
                        $result = "Fail";
                        $display = "Failed";
                    }
                } else {
                    $result = "Not Applicable";
                    $display = "Completed";
                }
                if (isset($testResultsModel) && !empty($testResultsModel)) {
                    $this->render('testResults', array(
                        'testResults' => $testResultsModel, 'display' => $display
                    ));
                } else {
                    $testResultsModel = new Testresults();
                    $testResultsModel->user_id = Yii::app()->user->memId;
                    $testResultsModel->course_id = $assignTestsModel->course_id;
                    $testResultsModel->test_type_id = $assignTestsModel->test_id;
                    $testResultsModel->total_questions = $assignTestsModel->total_questions;
                    $testResultsModel->total_marks = $assignTestsModel->total_marks;
                    $testResultsModel->obtained_marks = $obtMarks;
                    $testResultsModel->result = $result;
                    $testResultsModel->attempted_on = date('Y-m-d h:i:s');
                    $testResultsModel->time_consumed = $consumedMin . ':' . $consumedSec;
                    $testResultsModel->test_questions = $testQuestions;
                    if ($testResultsModel->validate()) {
                        if ($testResultsModel->save()) {
                            $this->render('testResults', array(
                                'testResults' => $testResultsModel, 'display' => $display
                            ));
                        }
                    }
                }
            } else {
                $testResultsModel = new Testresults();
                $totalQuestions = count($_POST['questions']);
                $totalTime = $assignTestsModel->duration;
                $consumedMin = ($totalTime - $_POST['timeconsumedmin']) - 1;
                $consumedSec = 60 - $_POST['timeconsumedsec'];
                $noOfCorrectAns = 0;
                $testQuestions = '';
                foreach ($_POST['questions'] as $key => $value) {
                    $testQuestions.= $value . ',';
                }
                if (isset($_POST['answers']) && !empty($_POST['answers'])) {
                    foreach ($_POST['answers'] as $key => $value) {
                        if ($value == $_POST['correctAns'][$key]) {
                            $noOfCorrectAns++;
                        }
                    }
                }
                $obtMarks = ceil($noOfCorrectAns * ($assignTestsModel->total_marks / count($_POST['questions'])));
                if ($assignTestsModel->test_id == 2) {
                    if ($obtMarks >= $assignTestsModel->pass_marks) {
                        $result = "Pass";
                        $display = "Passed";
                    } else {
                        $result = "Fail";
                        $display = "Failed";
                    }
                } else {
                    $result = "Not Applicable";
                    $display = "Completed";
                }
                $testResultsModel->user_id = Yii::app()->user->memId;
                $testResultsModel->course_id = $assignTestsModel->course_id;
                $testResultsModel->test_type_id = $assignTestsModel->test_id;
                $testResultsModel->total_questions = $assignTestsModel->total_questions;
                $testResultsModel->total_marks = $assignTestsModel->total_marks;
                $testResultsModel->obtained_marks = $obtMarks;
                $testResultsModel->result = $result;
                $testResultsModel->attempted_on = date('Y-m-d h:i:s');
                $testResultsModel->time_consumed = $consumedMin . ':' . $consumedSec;
                $testResultsModel->test_questions = $testQuestions;
                if ($testResultsModel->validate()) {
                    if ($testResultsModel->save()) {
                        $this->render('testResults', array(
                            'testResults' => $testResultsModel, 'display' => $display
                        ));
                    }
                }
            }
        } else {
            $this->layout = '//layouts/main';
            $this->render('index');
        }
    }

    public function actionuserPdfView() {
        $userActivity = new Useractivity();
        $userActivity->course_id = $_POST['courseId'];
        $userActivity->course_sub_link = $_POST['subLinkId'];
        $userActivity->pdf_download = 1;
        $userActivity->video_view = 0;
        $userActivity->created_on = date('Y-m-d h:i:s');
        $userActivity->message = 'PDF Downloaded for '.Coursedetails::model()->getCourseDetailsName($_POST['subLinkId']);
        $userActivity->user_id = Yii::app()->user->memId;
        if ($userActivity->validate()) {
            if ($userActivity->save()) {
                echo "success";
            }
        }
    }
    
    public function actionuserVideoView() {
        $userActivity = new Useractivity();
        if($_POST['time']!="complete"){
            if($_POST['time']==0){
                $time = 'starting ';
            }else{
                $min = floor(ceil($_POST['time'])/60);
            $sec = ceil($_POST['time'])%60;
            $time = $min.':'.$sec.' Min';
            }
            
        }else{
            $time = '';
        }
       
        $userActivity->course_id = $_POST['courseId'];
        $userActivity->course_sub_link = $_POST['subCourseId'];
        $userActivity->pdf_download = 0;
        $userActivity->video_view = 1;
        $userActivity->created_on = date('Y-m-d h:i:s');
        $userActivity->message = $_POST['msg'].$time.' for '.Coursedetails::model()->getCourseDetailsName($_POST['subCourseId']);
        $userActivity->user_id = Yii::app()->user->memId;
//        print_r($userActivity->attributes);exit;
        if ($userActivity->validate()) {
            if ($userActivity->save()) {
                echo "success";
            }
        }
    }

    public function actionUploadProfilePic() {
        $user = User::model()->findByPk(Yii::app()->user->memId);
        if (isset($_FILES['profilePic']['name']) && !empty($_FILES['profilePic']['name'])) {
            $uploaddir = 'uploads/profilePic/';
            $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['profilePic']['name']);
            $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['profilePic']['name']);
            if ((is_dir('uploads/profilePic/'))) {
                
            } else {
                mkdir('uploads/profilePic/', 0777, true);
            }
            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadfile)) {
                
            }
            $user->profilePic = $filename;
        }

        if ($user->validate()) {
            if ($user->save()) {
                
            }
        }
        $this->redirect('landing');
    }

    public function actionchangePassword() {
        $user = new User();
        $this->layout = '//layouts/main';
        if (isset(Yii::app()->user->memId)) {
            $user = User::model()->findByPk(Yii::app()->user->memId);
            if (isset($user) && !empty($user)) {
                $this->render('changepassword', array('currentPasword' => $user->password));
            } else {
                $this->render('changepassword');
            }
        } else {
            $this->layout = '//layouts/main';
            $this->render('index');
        }
    }

    public function actionchangePasswordConfirm() {
        $this->layout = '//layouts/main';
        $user = new User();
        $user = User::model()->findByPk(Yii::app()->user->memId);
        if (isset($_POST['originalpwd']) && !empty($_POST['originalpwd']) && (md5($_POST['originalpwd']) == $_POST['orgpwd'])) {
            if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['passwordConfirm']) && !empty($_POST['passwordConfirm']) && ($_POST['passwordConfirm'] == $_POST['password'] )) {
                if (md5($_POST['password']) == $_POST['orgpwd']) {
                    if (isset($user) && !empty($user)) {
                        Yii::app()->user->setFlash('error', "Current Password and New passwords are Same...Please Try again with Valid Details.");
                        $this->render('changepassword', array('currentPasword' => $user->password));
                    } else {
                        Yii::app()->user->setFlash('error', "Current Password and New passwords are Same...Please Try again with Valid Details.");
                        $this->render('changepassword');
                    }
                } else {
                    $user->password = md5($_POST['password']);
                    $user->updated_on = date('Y-m-d h:i:s');
                    if ($user->validate()) {
                        if ($user->save()) {
                            require_once('sm_assets/mailer/PHPMailerAutoload.php');
                            $mail = new PHPMailer();
                            $body = '<!-- 
                                                         * Template Name: Unify - Responsive Bootstrap Template
                                                         * Description: Business, Corporate, Portfolio and Blog Theme.
                                                         * Version: 1.6
                                                         * Author: @htmlstream
                                                         * Website: http://htmlstream.com
                                                         -->
                                                        <!doctype html>
                                                        <html xmlns="http://www.w3.org/1999/xhtml">
                                                        <head>
                                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                        <title>Job Portal Password changed successfully</title>

                                                        <style type="text/css">
                                                            .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                                            .ExternalClass {width: 100%; background-color: #ffffff;}
                                                            body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                                            table {border-collapse: collapse;}

                                                            @media only screen and (max-width: 640px)  {
                                                                            body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }

                                                            @media only screen and (max-width: 479px) {
                                                                            body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }
                                                        </style>
                                                        </head>
                                                        <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                                        <!-- Wrapper -->
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                                    <!--Start Header-->
                                                                    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td style="padding: 6px 0px 0px">
                                                                                <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td width="100%" >
                                                                                            <!--Start logo-->
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                <tr>
                                                                                                    <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                                        <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table><!--End logo-->
                                                                                            <!--Start nav-->
                                                                                            <!--End nav-->
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                           </td>
                                                                        </tr>
                                                                    </table> 
                                                                    <!--End Header-->

                                                                    <!-- Start Headliner-->                                                                                       

                                                                    <div style="height:15px">&nbsp;</div><!-- divider -->

                                                                    <!--Start Discount -->
                                                                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td width="100%" bgcolor="#ffffff">
                                                                                <!-- Left Box  -->
                                                                                <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td class="center">
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                                                <tr>
                                                                                                    <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Dear , ' . $user->username . ' ,                           
                                                                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Your password has been changed successfully.Please let us know immediately if this wasn\'t done by you.                         
                                                                                                   </td>
                                                                                                </tr>  
                                                                                                                                                                                                                     
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>       



                                                                            </td>
                                                                        </tr>
                                                                    </table>                                                                                       

                                                                </td>
                                                            </tr>
                                                        </table> 
                                                        <!-- End Wrapper -->
                                                        </body>
                                                        </html>';
                            $mail->IsSMTP(); // telling the class to use SMTP
                            $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                            //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                            $mail->SMTPAuth = true;                  // enable SMTP authentication
                            $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                            //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                            $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                            $mail->Password = Yii::app()->params['emailPassword'];
                            $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                            $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                            $mail->Subject = "Password Changed";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $user->email;
                            $mail->AddAddress($address, $user->email);
                            $mail->isHTML(true);

                            //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                            if (!$mail->Send()) {
                                //  echo "Mailer Error: " . $mail->ErrorInfo;
                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Updating Password...Please Try Later...!");
                            } else {
                                Yii::app()->user->setFlash('success', "Password is updated Successfully.");
                                $this->render('changepassword', array('currentPasword' => $user->password));
                            }
                        }
                    }
                }
            } else {
                if (isset($user) && !empty($user)) {
                    Yii::app()->user->setFlash('error', "New Password and Verify New Passwords are not matching...Please Try again with Valid Details.");
                    $this->render('changepassword', array('currentPasword' => $user->password));
                } else {
                    Yii::app()->user->setFlash('error', "New Password and Verify New Passwords are not matching...Please Try again with Valid Details.");
                    $this->render('changepassword');
                }
            }
        } else {
            if (isset($user) && !empty($user)) {
                Yii::app()->user->setFlash('error', "Current Password is not matching with your Given Password...Please Try again with Valid Details.");
                $this->render('changepassword', array('currentPasword' => $user->password));
            } else {
                Yii::app()->user->setFlash('error', "Current Password is not matching with your Given Password...Please Try again with Valid Details.");
                $this->render('changepassword');
            }
        }
    }

    public function actionReports() {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "reports");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
        $criteria->condition = 't.test_type_id=:test_type_id';
        $criteria->params = array(':test_type_id' => 2);
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }

        $models = Yii::app()->db->createCommand()
                ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                ->from('testresults t')
                ->leftJoin('courses c', 'c.id=t.course_id')
                ->leftJoin('user u', 'u.id=t.user_id')
                ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                ->order('t.attempted_on desc')
                ->where('t.test_type_id=:test_type_id', array('test_type_id' => 2))
                ->limit($pageSize, $from)
                ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count
        ));
    }

    public function actiontestRelutsMember() {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        Yii::app()->user->setState("menu", "testResults");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
        $criteria->condition = 't.user_id=:userId';
        $criteria->params = array(':userId' => Yii::app()->user->memId);
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }

        $models = Yii::app()->db->createCommand()
                ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                ->from('testresults t')
                ->leftJoin('courses c', 'c.id=t.course_id')
                ->leftJoin('user u', 'u.id=t.user_id')
                ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                ->where('t.user_id=:userId', array('userId' => Yii::app()->user->memId))
                ->order('t.attempted_on desc')
                ->limit($pageSize, $from)
                ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('memberreports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count
        ));
    }

    public function actionvisitedCourse() {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        Yii::app()->user->setState("menu", "visitedcourse");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
        $criteria->condition = 't.user_id=:userId';
        $criteria->params = array(':userId' => Yii::app()->user->memId);
        $count = Useractivity::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }

        $models = Yii::app()->db->createCommand()
                ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                ->from('useractivity t')
                ->leftJoin('courses c', 'c.id=t.course_id')
                ->leftJoin('user u', 'u.id=t.user_id')
                ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                ->where('t.user_id=:userId', array('userId' => Yii::app()->user->memId))
                ->order('t.created_on desc')
                ->limit($pageSize, $from)
                ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Useractivity::model()->count($criteria);

        $this->render('memberactivity', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count
        ));
    }

    public function actionsearchByCourseReportsMemberActivity($id) {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/main';
        Yii::app()->user->setState("menu", "visitedcourse");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
            $criteria->condition = 't.user_id=:userId AND t.course_id=:courseId';
            $criteria->params = array(':userId' => Yii::app()->user->memId, 'courseId' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
            $criteria->condition = 't.user_id=:userId';
            $criteria->params = array(':userId' => Yii::app()->user->memId);
        }
        $count = Useractivity::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->where('t.user_id=:userId AND t.course_id=:courseId', array('userId' => Yii::app()->user->memId, 'courseId' => $id))
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->where('t.user_id=:userId', array('userId' => Yii::app()->user->memId))
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

        $count = Useractivity::model()->count($criteria);

        $this->render('memberactivity', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    public function actionsearchByUserNameReports($id) {
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "reports");

        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
        $criteria->condition = 't.test_type_id=:test_type_id';
        $criteria->params = array(':test_type_id' => 2);
        if ($id != "All") {
            $criteria->condition = "user_id=:value AND t.test_type_id=:test_type_id";
            $criteria->params = array(':value' => $id, ':test_type_id' => 2);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.user_id=:user_id AND t.test_type_id=:test_type_id', array(':user_id' => $id, ':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'userId' => $id
        ));
    }

    public function actionsearchByDesignationsReports($id) {
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "reports");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id AND user.designation=:email';
            $criteria->condition = 't.test_type_id=:test_type_id';
            $criteria->params = array(':email' => $id, ':test_type_id' => 2);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.test_type_id=:test_type_id';
            $criteria->params = array(':test_type_id' => 2);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('u.designation=:designation AND t.test_type_id=:test_type_id', array(':designation' => $id, ':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'designationId' => $id
        ));
    }

    public function actionsearchByStateReports($id) {
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "reports");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id AND user.state=:state';
            $criteria->condition = 't.test_type_id=:test_type_id';
            $criteria->params = array(':state' => $id, ':test_type_id' => 2);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.test_type_id=:test_type_id';
            $criteria->params = array(':test_type_id' => 2);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('u.state=:state  AND t.test_type_id=:test_type_id', array(':state' => $id, ':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'stateId' => $id
        ));
    }

    public function actionsearchByCourseReports($id) {
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "reports");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.course_id=:courses AND t.test_type_id=:test_type_id';
            $criteria->params = array(':courses' => $id, ':test_type_id' => 2);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.test_type_id=:test_type_id';
            $criteria->params = array(':test_type_id' => 2);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.course_id=:course_id  AND t.test_type_id=:test_type_id', array(':course_id' => $id, ':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => 2))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    public function actionsearchByTestTypeReports($id) {
        $this->layout = '//layouts/courses';
        Yii::app()->user->setState("menu", "testResults");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id   AND t.test_type_id=:test_type_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->params = array(':test_type_id' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'testId' => $id
        ));
    }

    public function actionsearchByCourseReportsMember($id) {
        $this->layout = '//layouts/main';
        Yii::app()->user->setState("menu", "testResults");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.user_id=:userId AND t.course_id=:courses';
            $criteria->params = array(':courses' => $id, ':userId' => Yii::app()->user->memId);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.user_id=:userId';
            $criteria->params = array(':userId' => Yii::app()->user->memId);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.course_id=:course_id AND t.user_id=:userId', array(':course_id' => $id, ':userId' => Yii::app()->user->memId))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.user_id=:userId', array(':userId' => Yii::app()->user->memId))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('memberreports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    public function actionsearchByTestTypeReportsMember($id) {
        $this->layout = '//layouts/main';
        Yii::app()->user->setState("menu", "reports");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.test_type_id=:test_type_id AND t.user_id=:userId';
            $criteria->params = array(':test_type_id' => $id, ':userId' => Yii::app()->user->memId);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->condition = 't.user_id=:userId';
            $criteria->params = array(':userId' => Yii::app()->user->memId);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id AND t.user_id=:userId', array(':test_type_id' => $id, ':userId' => Yii::app()->user->memId))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.user_id=:userId', array(':userId' => Yii::app()->user->memId))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('memberreports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'testId' => $id
        ));
    }

    public function actioncontactUs() {
        $this->layout = '//layouts/main';

        if (isset($_POST['Contactus'])) {
            $model = new Contactus();
            $model->attributes = $_POST['Contactus'];
            $model->created_on = date('Y-m-d H:i:s');

            if ($model->validate()) {
                if ($model->save()) {
                    require_once('sm_assets/mailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer();
                    $body = '<!-- 
                                                         * Template Name: Unify - Responsive Bootstrap Template
                                                         * Description: Business, Corporate, Portfolio and Blog Theme.
                                                         * Version: 1.6
                                                         * Author: @htmlstream
                                                         * Website: http://htmlstream.com
                                                         -->
                                                        <!doctype html>
                                                        <html xmlns="http://www.w3.org/1999/xhtml">
                                                        <head>
                                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                        <title>Job Portal User Complaint</title>

                                                        <style type="text/css">
                                                            .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                                            .ExternalClass {width: 100%; background-color: #ffffff;}
                                                            body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                                            table {border-collapse: collapse;}

                                                            @media only screen and (max-width: 640px)  {
                                                                            body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }

                                                            @media only screen and (max-width: 479px) {
                                                                            body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                                            body[yahoo] .center {text-align: center!important;}  
                                                                    }
                                                        </style>
                                                        </head>
                                                        <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                                        <!-- Wrapper -->
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                                    <!--Start Header-->
                                                                    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td style="padding: 6px 0px 0px">
                                                                                <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td width="100%" >
                                                                                            <!--Start logo-->
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                <tr>
                                                                                                    <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                                        <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table><!--End logo-->
                                                                                            <!--Start nav-->
                                                                                            <!--End nav-->
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                           </td>
                                                                        </tr>
                                                                    </table> 
                                                                    <!--End Header-->

                                                                    <!-- Start Headliner-->                                                                                       

                                                                    <div style="height:15px">&nbsp;</div><!-- divider -->

                                                                    <!--Start Discount -->
                                                                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                        <tr>
                                                                            <td width="100%" bgcolor="#ffffff">
                                                                                <!-- Left Box  -->
                                                                                <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                    <tr>
                                                                                        <td class="center">
                                                                                            <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                                                <tr>
                                                                                                    <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Dear Admin, ' . $model->name . ' ( ' . $model->email . ' ) has A Complaint About   ' . $model->message . '    <br>                         
                                                                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        ' . $model->message . '    <br>
                                                                                                   </td>
                                                                                                </tr>  
                                                                                                                                                                                                                     
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>       



                                                                            </td>
                                                                        </tr>
                                                                    </table>                                                                                       

                                                                </td>
                                                            </tr>
                                                        </table> 
                                                        <!-- End Wrapper -->
                                                        </body>
                                                        </html>';

                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host = Yii::app()->params['emailHost']; // SMTP server
                    //                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                    $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
                    //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                    $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
                    $mail->Password = Yii::app()->params['emailPassword'];
                    $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
                    $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
                    $mail->Subject = "Complaint About OLP";
                    //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                    $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                    $mail->Port = 587;
                    $address = Yii::app()->params['contactComplaintEmail'];
                    $mail->AddAddress($address, Yii::app()->params['contactComplaintEmail']);
                    $mail->isHTML(true);

                    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                    if (!$mail->Send()) {
                        //  echo "Mailer Error: " . $mail->ErrorInfo;
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Submitting Query...Please Try Later...!");
                    } else {
                        Yii::app()->user->setFlash('success', "Your Query Posted Successfully");
                    }
                    $this->render('contactus');
                }
            }
        } else {
            $this->render('contactus');
        }
    }

    public function actionDownload($name, $path) {


        //This application is developed by www.webinfopedia.com
//visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
        function output_file($file, $name, $mime_type = '') {
            /*
              This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
             */

            //Check the file premission
            if (!is_readable($file))
                die('File not found or inaccessible!');

            $size = filesize($file);
            $name = rawurldecode($name);

            /* Figure out the MIME type | Check in array */
            $known_mime_types = array(
                "pdf" => "application/pdf",
                "txt" => "text/plain",
                "html" => "text/html",
                "htm" => "text/html",
                "exe" => "application/octet-stream",
                "zip" => "application/zip",
                "doc" => "application/msword",
                "xls" => "application/vnd.ms-excel",
                "ppt" => "application/vnd.ms-powerpoint",
                "gif" => "image/gif",
                "png" => "image/png",
                "jpeg" => "image/jpg",
                "jpg" => "image/jpg",
                "php" => "text/plain"
            );

            if ($mime_type == '') {
                $file_extension = strtolower(substr(strrchr($file, "."), 1));
                if (array_key_exists($file_extension, $known_mime_types)) {
                    $mime_type = $known_mime_types[$file_extension];
                } else {
                    $mime_type = "application/force-download";
                };
            };

            //turn off output buffering to decrease cpu usage
            @ob_end_clean();

            // required for IE, otherwise Content-Disposition may be ignored
            if (ini_get('zlib.output_compression'))
                ini_set('zlib.output_compression', 'Off');

            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . $name . '"');
            header("Content-Transfer-Encoding: binary");
            header('Accept-Ranges: bytes');

            /* The three lines below basically make the 
              download non-cacheable */
            header("Cache-control: private");
            header('Pragma: private');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

            // multipart-download and download resuming support
            if (isset($_SERVER['HTTP_RANGE'])) {
                list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
                list($range) = explode(",", $range, 2);
                list($range, $range_end) = explode("-", $range);
                $range = intval($range);
                if (!$range_end) {
                    $range_end = $size - 1;
                } else {
                    $range_end = intval($range_end);
                }
                /*
                  ------------------------------------------------------------------------------------------------------
                  //This application is developed by www.webinfopedia.com
                  //visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
                  ------------------------------------------------------------------------------------------------------
                 */
                $new_length = $range_end - $range + 1;
                header("HTTP/1.1 206 Partial Content");
                header("Content-Length: $new_length");
                header("Content-Range: bytes $range-$range_end/$size");
            } else {
                $new_length = $size;
                header("Content-Length: " . $size);
            }

            /* Will output the file itself */
            $chunksize = 1 * (1024 * 1024); //you may want to change this
            $bytes_send = 0;
            if ($file = fopen($file, 'r')) {
                if (isset($_SERVER['HTTP_RANGE']))
                    fseek($file, $range);

                while (!feof($file) &&
                (!connection_aborted()) &&
                ($bytes_send < $new_length)
                ) {
                    $buffer = fread($file, $chunksize);
                    print($buffer); //echo($buffer); // can also possible
                    flush();
                    $bytes_send += strlen($buffer);
                }
                fclose($file);
            } else
            //If no permissiion
                die('Error - can not open file.');
            //die
            die();
        }

//Set the time out
        set_time_limit(0);

//path to the file
        $file_path = $path . '/' . $name;


//Call the download function with file path,file name and file type
        output_file($file_path, '' . $name . '');
    }

    public function actionsendMsg() {

        $r = new HttpRequest('http://www.siegsms.com/sendingsms.aspx', HttpRequest::METH_GET);
        $r->addQueryData(array('userid' => 'digitalteacher'));
        $r->addQueryData(array('pass' => 'digiteacher@123'));
        $r->addQueryData(array('phone' => '8099372431'));
        $r->addQueryData(array('msg' => 'demo'));
        echo "sdasd";
        exit;
        try {
            $r->send();
            if ($r->getResponseCode() == 200) {
                echo $r->getResponseBody();
            }
        } catch (HttpException $ex) {
            echo $ex;
        }
//        $response = file_get_contents('http://www.siegsms.com/SendingSms.aspx?userid=digitalteacher&pass=digiteacher@123&phone=8106909332&msg=t&title=DGTCHR');
//echo $response;
    }

    public function actionTest() {
        $url = 'http://www.siegsms.com/SendingSms.aspx?userid=digitalteacher&pass=digiteacher@123&phone=8106909332&msg=8099&title=DGTCHR';
        // create a new cURL resource
        $curl = curl_init();
        // set URL and other appropriate options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        // grab URL and pass it to the browser
        if (curl_exec($curl)) {
            
        } else {
            
        }
        if (curl_errno($curl)) {
            print curl_error($curl);
        } else {
            curl_close($curl);
        }
    }

}

