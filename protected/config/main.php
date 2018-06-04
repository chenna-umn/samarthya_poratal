<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Job Portal',
        'defaultController' => 'site',
        'timeZone' => 'Asia/Calcutta',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),	
        'modules' => array(
                    'gii' => array(
                            'class' => 'system.gii.GiiModule',
                            'password' => 'yii',
                            'ipFilters' => array('127.0.0.1','::1'),
                    ),
            ),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
//		'db'=>array(
//			'connectionString' => 'sqlite:protected/data/blog.db',
//			'tablePrefix' => 'tbl_',
//		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=samarthya',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false, 
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
                                'searchbysubcat-<title:.*?>-<id:\d+>.<exe:.*?>'=>'site/SearchBySubcat',
                                'jd-<title:.*?>-<id:\d+>.<exe:.*?>'=>'site/JobDescription',
                                'upjob-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/updatejob',
                                'mp-<title:.*?>-<id:\d+>.<exe:.*?>'=>'member/memberProfile',
                                'aplj-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/SearchAppliedListByJobId',
                                'svdj-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/SearchSavedListByJobId',
                                'upsrf-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/updateSavedResumeFinder',
                                'srchrf-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/updateSavedResumeSearch',
                                'udsrf-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/updateSavedResume',
                                'dwr-<title:.*?>-<name:\w+>-<path:\w+>.<exe:.*?>'=>'Member/download',
                                'aboutus.<exe:.*?>'=>'site/aboutUs',
                                'terms.<exe:.*?>'=>'site/termsAndConditions',
                                'privacy.<exe:.*?>'=>'site/privacyPolicy',
                                'fraudalert.<exe:.*?>'=>'site/fraudAlert',
                                'contact.<exe:.*?>'=>'site/contactUs',
                                'uprec-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Recruiter/updateprofile',
                                'memcrt1-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Member/create1',
                                'memcrt2-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Member/create2',
                                'memcrt3-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Member/create3',
                                'memcrt4-<title:.*?>-<id:\d+>.<exe:.*?>'=>'Member/create4',
                                'remappm-<title:.*?>-<id:\d+>.<exe:.*?>'=>'site/remaindApproval',
                                'remappr-<title:.*?>-<id:\d+>.<exe:.*?>'=>'site/remaindApprovalRec',
                                ''=>'site/index',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);