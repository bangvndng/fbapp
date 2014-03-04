<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'おもしろ診断盛りだくさんの【ただいま診断中】',

	// preloading 'log' component
	'preload'=>array('log'),
	'theme'=>'fbapp',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
	),

	'defaultController'=>'home',

	'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123123',
            'generatorPaths'=>array(
                'bootstrap.gii',
                // 'ext.bootstrap.gii'
            ),
        ),
        'user'=>array(
        	'tableUsers' => 'users',
  			'tableProfiles' => 'profiles',
  			'tableProfileFields' => 'profiles_fields',
			# encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/site/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/site/login'),
        ),
    ),

	// application components
	'components'=>array(
		 'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
		'bitly' => array(
	        'class' => 'application.extensions.bitly.VGBitly',
	        'login' => 'jellydn', // login name
	        'apiKey' => 'R_84cf8534cdf699afa0b65ae600c3d97e', // apikey 
	        'format' => 'json', // default format of the response this can be either xml, json (some callbacks support txt as well)
        	'returnAsArray' => true,
        ),
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/site/login'),
        ),
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:protected/data/blog.db',
		// 	'tablePrefix' => 'tbl_',
		// ),
		// uncomment the following to use a MySQL database
		// 'db'=>array(
		// 	'connectionString' => 'mysql:host=127.8.150.130;dbname=demo',
		// 	'emulatePrepare' => true,
		// 	'username' => 'admin2b2gIdP',
		// 	'password' => 'qRkdryb7Qd25',
		// 	'charset' => 'utf8',
		// 	'tablePrefix' => 'tbl_',
		// ),
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=fbapps',
			'emulatePrepare' => true,
			// 'username' => 'adminBgugSAj',
			'username' => 'root',
			// 'password' => 'GqEjA8BDGfEw',
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
		    // 'caseSensitive'=>false,
			'rules'=>array(
				'/privacy' => '/site/privacy',
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