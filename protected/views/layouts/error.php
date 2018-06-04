<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <title>Samarthya::Online Learning Portal for Technical Staff under MGNREGA</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">

         <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/js/jquery-1.11.1.min.js"></script>         
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/js/bootstrap.min.js"></script>  
    </head> 	
    <body class="header-fixed">     
        <?php $this->renderPartial('//layouts/header'); ?>
         
        <?php
        Yii::app()->clientScript->registerScript(
                'myHideEffect', '$(".info1").animate({opacity: 1.0}, 10000).fadeOut("slow");', CClientScript::POS_READY
        );
        ?>
        <?php echo $content; ?>
    