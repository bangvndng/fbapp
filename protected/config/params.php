<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'FB Like Demo',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2013 by Green Global.',
	'perms'  => array(
		'email' => 'Email',
		'user_birthday' => 'user_birthday',
		'user_hometown' => 'user_hometown',
		'user_location' => 'user_location',
		'publish_actions' => 'publish_actions',
		'user_likes' => 'user_likes',
		'user_relationships' => 'user_relationships',
		'friends_birthday' => 'friends_birthday'
	)
);
