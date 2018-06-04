<?php

class NicdataController extends Controller {

    public $layout = 'nicdata';
    public $defaultAction = 'index';

    public function actionIndex() {
        $model = new Nicdata();
        if (isset($_POST['Nicdata'])) {
            $model->attributes = $_POST['Nicdata'];
            $model->state = State::model()->getStateName($_POST['Nicdata']['state_code']);
            ;
            $model->created_on = date('Y-m-d h:i:s');

            $model->username = $_POST['Nicdata']['email'];
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "New User Added Successfully");
                    $this->redirect(array('Nicdata/index'));
                }
            } else {
                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New User...Please Try Later...!");
                $this->redirect(array('Nicdata/index'));
            }
        }
        $this->render('index');
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

    /**
     * To check that email is already registered or not
     */
    public function actioncheckmobile() {

        if (isset($_POST['mobile'])) {
            $model = User::model()->find('mobile=:mobile', array(':mobile' => $_POST['mobile']));
            if (isset($model) && !empty($model)) {
                echo "registered";
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actioncheckaadhar() {

        if (isset($_POST['aadhar'])) {
            $model = User::model()->find('adhaar=:adhaar', array(':adhaar' => $_POST['aadhar']));
            if (isset($model) && !empty($model)) {
                echo "registered";
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    public function actioncheckUsernameAvail() {

        if (isset($_POST['userName'])) {
            $model = User::model()->find('username=:username', array(':username' => $_POST['userName']));
            if (isset($model) && !empty($model)) {
                echo "registered";
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actionVerifyMobile() {

        if (isset($_POST['mobile_no']) && $_POST['state_code']) {
            $model = Nicdata::model()->find('mobile=:mobile AND state_code=:state_code', array(':mobile' => $_POST['mobile_no'], 'state_code' => $_POST['state_code']));

            if (isset($model) && !empty($model)) {

                $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $_REQUEST['mobile_no']));
                if (isset($otpModel) && !empty($otpModel)) {
                    $otp = rand(100000, 999999);
                    $otpModel->attributes = $otpModel;
                    $otpModel->otp = $otp;
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;
                            $mobile = $_REQUEST['mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
                            echo $url1;
                            exit;
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
                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : , ' . $otp . ',.                            
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
                            $mail->Subject = "OTP Detaits";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $model->email;
                            $mail->AddAddress($address, $model->email);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                } else {

                    $otpModel = new Otpnumber();
                    $otp = rand(100000, 999999);
                    $otpModel->otp = $otp;
                    $otpModel->mobile = $_REQUEST['mobile_no'];
                    $otpModel->created_on = date('Y-m-d h:i:s');
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;

                            $mobile = $_REQUEST['mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
                            echo $url1;
                            exit;
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
                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : , ' . $otp . ',.                            
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
                            $mail->Subject = "OTP Detaits";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $model->email;
                            $mail->AddAddress($address, $model->email);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                }
                $data['firstname'] = $model->firstname;
                $data['lastname'] = $model->lastname;
                $data['staffid'] = $model->staffid;
                $data['designation'] = $model->designation;
                $data['email'] = $model->email;
                $data['mobile'] = $model->mobile;
                $data['state_code'] = $model->state_code;
                $data['aadhaar_no'] = $model->aadhaar_no;
                echo json_encode($data);
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actionVerifyAadhaar() {

        if (isset($_POST['aadhaar_no']) && $_POST['state_code']) {
            $model = Nicdata::model()->find('aadhaar_no=:aadhaar_no AND state_code=:state_code', array(':aadhaar_no' => $_POST['aadhaar_no'], 'state_code' => $_POST['state_code']));

            if (isset($model) && !empty($model)) {

                $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $model->mobile));
                if (isset($otpModel) && !empty($otpModel)) {
                    $otp = rand(100000, 999999);
                    $otpModel->attributes = $otpModel;
                    $otpModel->otp = $otp;
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;
                            $mobile = $model->mobile;
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                    echo $url1;exit;
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
                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : , ' . $otp . ',.                            
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
                            $mail->Subject = "OTP Detaits";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $model->username;
                            $mail->AddAddress($address, $model->username);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                } else {

                    $otpModel = new Otpnumber();
                    $otp = rand(100000, 999999);
                    $otpModel->otp = $otp;
                    $otpModel->mobile = $model->mobile;
                    $otpModel->created_on = date('Y-m-d h:i:s');
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;

                            $mobile = $_REQUEST['mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
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
                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : , ' . $otp . ',.                            
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
                            $mail->Subject = "OTP Detaits";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $model->username;
                            $mail->AddAddress($address, $model->username);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                }
                $data['firstname'] = $model->firstname;
                $data['lastname'] = $model->lastname;
                $data['staffid'] = $model->staffid;
                $data['designation'] = $model->designation;
                $data['email'] = $model->email;
                $data['mobile'] = $model->mobile;
                $data['state_code'] = $model->state_code;
                $data['aadhaar_no'] = $model->aadhaar_no;
                echo json_encode($data);
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actioncheckDataAvail() {

        $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $_REQUEST['mobile']));
        if (isset($otpModel) && !empty($otpModel)) {
            $otp = rand(100000, 999999);
            $otpModel->attributes = $otpModel;
            $otpModel->otp = $otp;
            $otpModel->updated_on = date('Y-m-d h:i:s');
            if ($otpModel->validate()) {
                if ($otpModel->save()) {
                    $msg = 'OTP for OLP is' . $otpModel->otp;
                    $mobile = $_REQUEST['mobile'];
                    $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                    echo $url1;exit;
                    $url = 'http://www.siegsms.com/SendingSms.aspx?userid=digitalteacher&pass=digiteacher@123&phone=8106909332&msg=8099&title=DGTCHR';
                    // create a new cURL resource
                    $curl = curl_init();
                    // set URL and other appropriate options
                    curl_setopt($curl, CURLOPT_URL, $url1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    // grab URL and pass it to the browser
                    if (curl_exec($curl)) {
                        echo "Sent";
                    } else {
                        
                    }
                    if (curl_errno($curl)) {
                        print curl_error($curl);
                    } else {
                        curl_close($curl);
                    }
//                            require_once('sm_assets/mailer/PHPMailerAutoload.php');
//                        $mail = new PHPMailer();
//                        //$body             = file_get_contents('contents.html');
//                        $body = '<!-- 
//                                                                                     * Template Name: Unify - Responsive Bootstrap Template
//                                                                                     * Description: Business, Corporate, Portfolio and Blog Theme.
//                                                                                     * Version: 1.6
//                                                                                     * Author: @htmlstream
//                                                                                     * Website: http://htmlstream.com
//                                                                                     -->
//                                                                                    <!doctype html>
//                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
//                                                                                    <head>
//                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
//                                                                                    <title>JOB PORTAL SIT Member Registration Confirmation</title>
//
//                                                                                    <style type="text/css">
//                                                                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
//                                                                                        .ExternalClass {width: 100%; background-color: #ffffff;}
//                                                                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
//                                                                                        table {border-collapse: collapse;}
//
//                                                                                        @media only screen and (max-width: 640px)  {
//                                                                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
//                                                                                                        body[yahoo] .center {text-align: center!important;}  
//                                                                                                }
//
//                                                                                        @media only screen and (max-width: 479px) {
//                                                                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
//                                                                                                        body[yahoo] .center {text-align: center!important;}  
//                                                                                                }
//                                                                                    </style>
//                                                                                    </head>
//                                                                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">
//
//                                                                                    <!-- Wrapper -->
//                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
//                                                                                        <tr>
//                                                                                            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">
//
//                                                                                                <!--Start Header-->
//                                                                                                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
//                                                                                                    <tr>
//                                                                                                        <td style="padding: 6px 0px 0px">
//                                                                                                            <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
//                                                                                                                <tr>
//                                                                                                                    <td width="100%" >
//                                                                                                                        <!--Start logo-->
//                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                                            <tr>
//                                                                                                                                <td class="center" style="padding: 10px 0px 10px 0px">
//                                                                                                                                    <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
//                                                                                                                                </td>
//                                                                                                                            </tr>
//                                                                                                                        </table><!--End logo-->
//                                                                                                                        <!--Start nav-->
//                                                                                                                        <!--End nav-->
//                                                                                                                    </td>
//                                                                                                                </tr>
//                                                                                                            </table>
//                                                                                                       </td>
//                                                                                                    </tr>
//                                                                                                </table> 
//                                                                                                <!--End Header-->
//
//                                                                                                <!-- Start Headliner-->                                                                                       
//
//                                                                                                <div style="height:15px">&nbsp;</div><!-- divider -->
//
//                                                                                                <!--Start Discount -->
//                                                                                                <table width="700" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                    <tr>
//                                                                                                        <td width="100%" bgcolor="#ffffff">
//                                                                                                            <!-- Left Box  -->
//                                                                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                                <tr>
//                                                                                                                    <td class="center">
//                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left"> 
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
//                                                                                                                               </td>
//                                                                                                                            </tr>
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    OTP code : , ' . $otp . ',.                            
//                                                                                                                               </td>
//                                                                                                                            </tr>                                                                                                                            
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Thanking You For Registering with us.                         
//                                                                                                                               </td>
//                                                                                                                            </tr>
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Best of luck,<br>
//                                                                                                                                    Team OLP<br>
//                                                                                                                                    <br>
//                                                                                                                               </td>
//                                                                                                                            </tr>                                                                                                               
//                                                                                                                        </table>
//                                                                                                                    </td>
//                                                                                                                </tr>
//                                                                                                            </table><!--End Left Box-->
//
//                                                                                                        </td>
//                                                                                                    </tr>
//                                                                                                </table>       
//
//
//
//                                                                                                        </td>
//                                                                                                    </tr>
//                                                                                                </table>                                                                                       
//
//                                                                                            </td>
//                                                                                        </tr>
//                                                                                    </table> 
//                                                                                    <!-- End Wrapper -->
//                                                                                    </body>
//                                                                                    </html>';
//                        $mail->IsSMTP(); // telling the class to use SMTP
//                        $mail->Host = "mail.lubainfo.in "; // SMTP server
////                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
//                        $mail->SMTPAuth = true;                  // enable SMTP authentication
//                        $mail->Host = "mail.lubainfo.in "; // sets the SMTP server
//                        //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
//                        $mail->Username = "support@lubainfo.in"; // SMTP account username
//                        $mail->Password = 'support12';
//                        $mail->SetFrom('support@lubainfo.in', 'OLP');
//                        $mail->AddReplyTo("support@lubainfo.in", "OLP");
//                        $mail->Subject = "OTP Detaits";
//                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//                        $mail->MsgHTML($body);        // SMTP password
////                                    $mail->SMTPSecure = 'tls';
//                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
//                        $mail->Port = 587;
//                        $address = $model->username;
//                        $mail->AddAddress($address, $model->username);
//                        //$mail->SMTPDebug  = 1;     
//                        $mail->isHTML(true);
//                        if (!$mail->Send()) {
//                            echo "notregistered";
//                        } else {
//                            echo "registered";
//                        } 
                }
            }
        } else {

            $otpModel = new Otpnumber();
            $otp = rand(100000, 999999);
            $otpModel->otp = $otp;
            $otpModel->mobile = $_REQUEST['mobile'];
            $otpModel->created_on = date('Y-m-d h:i:s');
            $otpModel->updated_on = date('Y-m-d h:i:s');
            if ($otpModel->validate()) {
                if ($otpModel->save()) {
                    $msg = 'OTP for OLP is' . $otpModel->otp;

                    $mobile = $_REQUEST['mobile'];
                    $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
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
                        echo "Sent";
                    } else {
                        
                    }
                    if (curl_errno($curl)) {
                        print curl_error($curl);
                    } else {
                        curl_close($curl);
                    }
//                            require_once('sm_assets/mailer/PHPMailerAutoload.php');
//                        $mail = new PHPMailer();
//                        //$body             = file_get_contents('contents.html');
//                        $body = '<!-- 
//                                                                                     * Template Name: Unify - Responsive Bootstrap Template
//                                                                                     * Description: Business, Corporate, Portfolio and Blog Theme.
//                                                                                     * Version: 1.6
//                                                                                     * Author: @htmlstream
//                                                                                     * Website: http://htmlstream.com
//                                                                                     -->
//                                                                                    <!doctype html>
//                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
//                                                                                    <head>
//                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
//                                                                                    <title>JOB PORTAL SIT Member Registration Confirmation</title>
//
//                                                                                    <style type="text/css">
//                                                                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
//                                                                                        .ExternalClass {width: 100%; background-color: #ffffff;}
//                                                                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
//                                                                                        table {border-collapse: collapse;}
//
//                                                                                        @media only screen and (max-width: 640px)  {
//                                                                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
//                                                                                                        body[yahoo] .center {text-align: center!important;}  
//                                                                                                }
//
//                                                                                        @media only screen and (max-width: 479px) {
//                                                                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
//                                                                                                        body[yahoo] .center {text-align: center!important;}  
//                                                                                                }
//                                                                                    </style>
//                                                                                    </head>
//                                                                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">
//
//                                                                                    <!-- Wrapper -->
//                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
//                                                                                        <tr>
//                                                                                            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">
//
//                                                                                                <!--Start Header-->
//                                                                                                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
//                                                                                                    <tr>
//                                                                                                        <td style="padding: 6px 0px 0px">
//                                                                                                            <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
//                                                                                                                <tr>
//                                                                                                                    <td width="100%" >
//                                                                                                                        <!--Start logo-->
//                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                                            <tr>
//                                                                                                                                <td class="center" style="padding: 10px 0px 10px 0px">
//                                                                                                                                    <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
//                                                                                                                                </td>
//                                                                                                                            </tr>
//                                                                                                                        </table><!--End logo-->
//                                                                                                                        <!--Start nav-->
//                                                                                                                        <!--End nav-->
//                                                                                                                    </td>
//                                                                                                                </tr>
//                                                                                                            </table>
//                                                                                                       </td>
//                                                                                                    </tr>
//                                                                                                </table> 
//                                                                                                <!--End Header-->
//
//                                                                                                <!-- Start Headliner-->                                                                                       
//
//                                                                                                <div style="height:15px">&nbsp;</div><!-- divider -->
//
//                                                                                                <!--Start Discount -->
//                                                                                                <table width="700" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                    <tr>
//                                                                                                        <td width="100%" bgcolor="#ffffff">
//                                                                                                            <!-- Left Box  -->
//                                                                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
//                                                                                                                <tr>
//                                                                                                                    <td class="center">
//                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left"> 
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Dear , ' . $model->email . ', Welcome to OLP.                            
//                                                                                                                               </td>
//                                                                                                                            </tr>
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    OTP code : , ' . $otp . ',.                            
//                                                                                                                               </td>
//                                                                                                                            </tr>                                                                                                                            
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Thanking You For Registering with us.                         
//                                                                                                                               </td>
//                                                                                                                            </tr>
//                                                                                                                            <tr>
//                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
//                                                                                                                                    Best of luck,<br>
//                                                                                                                                    Team OLP<br>
//                                                                                                                                    <br>
//                                                                                                                               </td>
//                                                                                                                            </tr>                                                                                                               
//                                                                                                                        </table>
//                                                                                                                    </td>
//                                                                                                                </tr>
//                                                                                                            </table><!--End Left Box-->
//
//                                                                                                        </td>
//                                                                                                    </tr>
//                                                                                                </table>       
//
//
//
//                                                                                                        </td>
//                                                                                                    </tr>
//                                                                                                </table>                                                                                       
//
//                                                                                            </td>
//                                                                                        </tr>
//                                                                                    </table> 
//                                                                                    <!-- End Wrapper -->
//                                                                                    </body>
//                                                                                    </html>';
//                        $mail->IsSMTP(); // telling the class to use SMTP
//                        $mail->Host = "mail.lubainfo.in "; // SMTP server
////                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
//                        $mail->SMTPAuth = true;                  // enable SMTP authentication
//                        $mail->Host = "mail.lubainfo.in "; // sets the SMTP server
//                        //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
//                        $mail->Username = "support@lubainfo.in"; // SMTP account username
//                        $mail->Password = 'support12';
//                        $mail->SetFrom('support@lubainfo.in', 'OLP');
//                        $mail->AddReplyTo("support@lubainfo.in", "OLP");
//                        $mail->Subject = "OTP Detaits";
//                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//                        $mail->MsgHTML($body);        // SMTP password
////                                    $mail->SMTPSecure = 'tls';
//                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
//                        $mail->Port = 587;
//                        $address = $model->username;
//                        $mail->AddAddress($address, $model->username);
//                        //$mail->SMTPDebug  = 1;     
//                        $mail->isHTML(true);
//                        if (!$mail->Send()) {
//                            echo "notregistered";
//                        } else {
//                            echo "registered";
//                        }
                }
            }
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actionresendOtp() {

        if (isset($_REQUEST['mobile'])) {
            $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $_REQUEST['mobile']));
            if (isset($otpModel) && !empty($otpModel)) {
                $otp = rand(100000, 999999);
                $otpModel->attributes = $otpModel;
                $otpModel->otp = $otp;
                $otpModel->updated_on = date('Y-m-d h:i:s');
                if ($otpModel->validate()) {
                    if ($otpModel->save()) {
                        $msg = 'Resend OTP for OPL is' . $otpModel->otp;
                        $mobile = $_REQUEST['mobile'];
                        $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
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
                                                                                                                                    Dear , ' . $_REQUEST['email'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code :' . $otp . '                            
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
                        $mail->Subject = "Resend OTP";
                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                        $mail->Port = 587;
                        $address = $_REQUEST['email'];
                        $mail->AddAddress($address, $_REQUEST['email']);
                        //$mail->SMTPDebug  = 1;     
                        $mail->isHTML(true);
                        if (!$mail->Send()) {
                            echo "fail";
                        } else {
                            echo "sent";
                        }
                    } else {
                        echo "fail";
                    }
                }
            } else {

                $otpModel = new Otpnumber();
                $otp = rand(100000, 999999);
                $otpModel->otp = $otp;
                $otpModel->mobile = $_POST['mobile'];
                $otpModel->created_on = date('Y-m-d h:i:s');
                $otpModel->updated_on = date('Y-m-d h:i:s');
                if ($otpModel->validate()) {
                    if ($otpModel->save()) {
                        $msg = 'Regenerated OTP for OLP is ' . $otpModel->otp;
                        $mobile = $_REQUEST['mobile'];
                        $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
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
                                                                                                                                    Dear , ' . $_REQUEST['email'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : , ' . $otp . ',.                            
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
                        $mail->Subject = "Regenerated OTP for OLP";
                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                        $mail->Port = 587;
                        $address = $_REQUEST['email'];
                        $mail->AddAddress($address, $_REQUEST['email']);
                        //$mail->SMTPDebug  = 1;     
                        $mail->isHTML(true);
                        if (!$mail->Send()) {
                            echo "mailfail";
                        } else {
                            echo "sent";
                        }
                    } else {
                        echo "fail";
                    }
                }
            }
        }
    }

    /**
     * To check that email is already registered or not
     */
    public function actiongetDataAvail() {

        if (isset($_POST['mobile']) && isset($_POST['state']) && isset($_POST['otp'])) {
            $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $_POST['mobile']));
            if (isset($otpModel) && !empty($otpModel)) {
                if ($otpModel->otp == $_POST['otp'] && $otpModel->mobile == $_POST['mobile']) {
                    echo "otpsuccess";
                } else {
                    echo "otpfail";
                }
            }
        }
    }    

    public function actiontestCurl() {

        //set POST variables      
        $fields_string = '';
        $url = 'http://164.100.129.6/netnrega/nrega_nird_olp.svc/VerifyMobile';
        $fields = array(
            'state_code' => urlencode($_POST['state_code']),
            'mobile_no' => urlencode($_POST['mobile_no'])
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

        print_r($results);
    }

    public function actionVerifyMobileService() {

        //set POST variables      
        $fields_string = '';
        $url = 'http://164.100.129.6/netnrega/nrega_nird_olp.svc/VerifyMobile';
        $fields = array(
            'state_code' => urlencode($_POST['state_code']),
            'mobile_no' => urlencode($_POST['mobile_no'])
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



        $checkUser = User::model()->find('staffid=:staffid AND state_code=:state_code', array('staffid' => $results['Response_Data']['Staff_id'], 'state_code' => $results['Response_Data']['State_code']));
        if (isset($checkUser) && !empty($checkUser)) {
            echo 'alreadyRegistered';
        } else {
            if (isset($results['Error_Code']) && !empty($results['Error_Code'])) {
                
            } else {



                $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $results['Response_Data']['Mobile_no']));

                if (isset($otpModel) && !empty($otpModel)) {
                    $otp = rand(100000, 999999);
                    $otpModel->attributes = $otpModel;
                    $otpModel->otp = $otp;
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is ' . $otpModel->otp;
                            $mobile = $results['Response_Data']['Mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                    echo $url1;exit;
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
                                                                                                                                    <a href="javascript:void(0)"><img src="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" /></a>
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
                                                                                                                                    Dear , ' . $results['Response_Data']['Email_id'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code :' . $otp . '.                            
                                                                                                                               </td>
                                                                                                                            </tr>                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For using our service.                         
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
                            $mail->Subject = "OTP Detaits from OLP";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $results['Response_Data']['Email_id'];
                            $mail->AddAddress($address, $results['Response_Data']['Email_id']);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                } else {

                    $otpModel = new Otpnumber();
                    $otp = rand(100000, 999999);
                    $otpModel->otp = $otp;
                    $otpModel->mobile = $results['Response_Data']['Mobile_no'];
                    $otpModel->created_on = date('Y-m-d h:i:s');
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is ' . $otpModel->otp;

                            $mobile = $results['Response_Data']['Mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                     echo $url1;exit;
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
                                                                                    <title>OLP otp code</title>

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
                                                                                                                                  <a href="javascript:void(0)"><img src="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" /></a>
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
                                                                                                                                    Dear , ' . $results['Response_Data']['Email_id'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code :' . $otp . '.                            
                                                                                                                               </td>
                                                                                                                            </tr>                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For using our service.                        
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
                            $mail->Subject = "OTP Detaits from OLP";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $results['Response_Data']['Email_id'];
                            $mail->AddAddress($address, $results['Response_Data']['Email_id']);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                }
            }
            echo json_encode($results);
        }
    }

    public function actionVerifyAadhaarService() {

        //set POST variables      
        $fields_string = '';
        $url = 'http://164.100.129.6/netnrega/nrega_nird_olp.svc/VerifyAadhaar';
        $fields = array(
            'state_code' => urlencode($_POST['state_code']),
            'aadhaar_no' => urlencode($_POST['aadhaar_no'])
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


        $checkUser = User::model()->find('staffid=:staffid AND state_code=:state_code', array('staffid' => $results['Response_Data']['Staff_id'], 'state_code' => $results['Response_Data']['State_code']));
        if (isset($checkUser) && !empty($checkUser)) {
            echo 'alreadyRegistered';
        } else {
            if (isset($results['Error_Code']) && !empty($results['Error_Code'])) {
                
            } else {
                $otpModel = Otpnumber::model()->find('mobile=:mobile', array(':mobile' => $results['Response_Data']['Mobile_no']));
                if (isset($otpModel) && !empty($otpModel)) {
                    $otp = rand(100000, 999999);
                    $otpModel->attributes = $otpModel;
                    $otpModel->otp = $otp;
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;
                            $mobile = $results['Response_Data']['Mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                    echo $url1;exit;
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
                                                                                                                                     <a href="javascript:void(0)"><img src="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" /></a>
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
                                                                                                                                    Dear , ' . $results['Response_Data']['Email_id'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : ' . $otp . '.                            
                                                                                                                               </td>
                                                                                                                            </tr>                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For using our service.                         
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
                            $mail->Subject = "OTP Detaits from OLP";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $results['Response_Data']['Email_id'];
                            $mail->AddAddress($address, $results['Response_Data']['Email_id']);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                } else {

                    $otpModel = new Otpnumber();
                    $otp = rand(100000, 999999);
                    $otpModel->otp = $otp;
                    $otpModel->mobile = $model->mobile;
                    $otpModel->created_on = date('Y-m-d h:i:s');
                    $otpModel->updated_on = date('Y-m-d h:i:s');
                    if ($otpModel->validate()) {
                        if ($otpModel->save()) {
                            $msg = 'OTP for OLP is' . $otpModel->otp;

                            $mobile = $results['Response_Data']['Mobile_no'];
                            $url1 = Yii::app()->params['smsSiteUrl'] . '?userid=' . Yii::app()->params['smsUserId'] . '&pass=' . Yii::app()->params['smsUserPass'] . '&phone=' . $mobile . '&msg=' . urlencode($msg) . '&title=' . Yii::app()->params['smstitle'];
//                     echo $url1;exit;
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
                                                                                                                                     <a href="javascript:void(0)"><img src="' . Yii::app()->params['domainName'] . Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" /></a>
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
                                                                                                                                    Dear , ' . $results['Response_Data']['Email_id'] . ', Welcome to OLP.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    OTP code : ' . $otp . '.                            
                                                                                                                               </td>
                                                                                                                            </tr>                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For using our service.                         
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
                            $mail->Subject = "OTP Detaits from OLP";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $results['Response_Data']['Email_id'];
                            $mail->AddAddress($address, $results['Response_Data']['Email_id']);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);
                            if (!$mail->Send()) {
                                
                            } else {
                                
                            }
                        }
                    }
                }
            }
            echo json_encode($results);
        }
    }
    
    
    public function actiondailyReports() {
        $report = $reports=array();
         $test = new DateTime(date('Y-m-d'));
          $from=  date_format($test, 'Y-m-d H:i:s');
          $to=date_format($test, 'Y-m-d 23:59:59');
           $dailyReports = Yii::app()->db->createCommand()
                ->select('t.*,c.courseCode as courseCode,u.staffid as staffid,u.state_code as state_code')
                ->from('testresults t')
                ->leftJoin('courses c', 'c.id=t.course_id')
                ->leftJoin('user u', 'u.id=t.user_id')               
                ->where('t.attempted_on >=:from AND  t.attempted_on <=:to AND t.test_type_id=:test_type_id', array('from' => $from,'to'=>$to,'test_type_id'=>2))
                ->order('t.attempted_on desc')                
                ->queryAll();
           
          
            $report['Count']=count($dailyReports);
           if(isset($dailyReports) && !empty($dailyReports)){
               foreach ($dailyReports as $key => $value) {
                   $reports[$key]['state_code'] = $value['state_code'];
                   $reports[$key]['training_id'] = $value['courseCode'];
                   $reports[$key]['staff_id'] = $value['staffid'];
                   $reports[$key]['obtained_marks'] = $value['obtained_marks'];
                   $reports[$key]['total_marks'] = $value['total_marks'];
                   $reports[$key]['attempted_on'] = date('m-d-Y h:i:s',strtotime($value['attempted_on']));
                   $reports[$key]['result'] = $value['result'];
               }
              
           }
           $report['TestReports']=$reports;
           
           echo json_encode($report);
    }

}