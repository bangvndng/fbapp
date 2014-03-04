FB Shindan Apps
=============================

Thank you for choosing Yii - a high-performance component-based PHP framework.

[![Build Status](https://secure.travis-ci.org/yiisoft/yii.png)](http://travis-ci.org/yiisoft/yii)

INSTALLATION
------------

Please make sure the release file is unpacked under a Web-accessible
directory. You shall see the following files and directories:

      protected/           our working area
      framework/           framework source files
      assets/              runtime assets folder      
      themes/              we have theme 'fbapp' for active theme which we used
      uploads/             uploads photo 
      README               this file


REQUIREMENTS
------------

The minimum requirement by Yii is that your Web server supports
PHP 5.1.0 or above. Yii has been tested with Apache HTTP server
on Windows and Linux operating systems.

Please access the following URL to check if your Web server reaches
the requirements by Yii, assuming "YiiPath" is where Yii is installed:

      http://hostname/YiiPath/requirements/index.php


Extensions
-----------

1.bitly	http://www.yiiframework.com/extension/bitly-url-shortener	

This extensions allows you to perform REST callbacks to the {@link bit.ly} service and perform several operations such as:

Shorten a url
Expand a short url into it's long form
Validate api login and key
Get the number of clicks for a short URL
Check if a domain uses the Bitly.Pro


2.bootstrap http://www.yiiframework.com/extension/bootstrap

This extension brings together Yii and Bootstrap, Twitter's HTML, CSS and JavaScript toolkit. It provides a wide range of widgets that allow you to easily use Bootstrap with Yii. All widgets have been developed following Yii's conventions and work seamlessly together with Bootstrap and its jQuery plugins.


3.elFinder http://www.yiiframework.com/extension/elfinder	
This extension allows use elFinder file manager in your Yii application. Possible usage:

chose file on server side (ServerFileInput widget)
manage files in specified folder (ElFinder widget)
add file browser to tinyMce wysiwyg editor

4.phpThumb http://www.yiiframework.com/extension/image-helper
This is a helper for creating and caching thumbnails. Based on PHPThumb, The benefit over the image component ported from kohana is that it allows more resizing methods (like adaptive resize.


5.tinymce http://www.yiiframework.com/extension/newtinymce
Almost in every application, i have need in wysiwyg editor for content. In most of them I have used tinymce extension writen by MetaYii(with some ugly changes, added by me, to connect elFinder file manager to it).

Recently I have written my own widget for TinyMce and for elFinder with possibility of integrating them. Also I have written separate actions for TinyMce compessor and for spellchecker plugin. So i think that my code looks more cleaner than something like tinymceelfinder extension, that has similar functionality.


DB
-----------

Please read file fb.sql	


Config protected/config/main.php
-----------
1. Application name
        'name'=>'Change any name if you want',
      
2. DB connection
'db'=>array(
            'connectionString' => 'mysql:host=127.5.31.2;dbname=fb',
            'emulatePrepare' => true,
            'username' => 'adminBgugSAj',
            'password' => 'GqEjA8BDGfEw',
            'charset' => 'utf8',
            'tablePrefix' => '',
    ),

Logic Process
-----------
Main process file: we store FB User infomation, display question and answer
protected/controllers/HomeController.php

We also have CRUD System for App,Question,Answer and report facebook user which used our application
protected/controllers/AnswersController.php
protected/controllers/QuestionsController.php
protected/controllers/AppsController.php
protected/controllers/FacebookUsersController.php

Author: DungHD
