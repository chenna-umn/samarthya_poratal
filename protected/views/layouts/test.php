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
        <link href="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/css/base.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" id="font-awesome-css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" media="screen">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/js/jquery-1.11.1.min.js"></script>         
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/js/md5.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/js/bootstrap.min.js"></script>  
        <style>
            .modal-backdrop {
                z-index: -1;
                background-color: #ffffff;;
            }


        </style>
        <script>
jQuery(document).ready(function() {
    var offset = 250;
    var duration = 300;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>
    </head> 	
    <body class="header-fixed" onLoad="noBack();" onpageshow="if (event.persisted) noBack();">     
        <div class="container page-wrapper">
        <?php $this->renderPartial('//layouts/header_test'); ?>

        <?php
        Yii::app()->clientScript->registerScript(
                'myHideEffect', '$(".info1").animate({opacity: 1.0}, 10000).fadeOut("slow");', CClientScript::POS_READY
        );
        ?>
        <?php echo $content; ?>
    