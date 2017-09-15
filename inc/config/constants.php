<?php
// The database connection parameters. Not all are required.
define('DB_HOST', 'localhost');
define('DB_PORT', 50001);
define('DB_NAME', 'vmsdev');
define('DB_USER', 'root');
define('DB_PASS', 'temp123');
define('DB_SCHEMA', 'DB2INST1');
define('DB_CATALOGED', true);

// The supported database connection adapters.
define('DB_DC_TYPE_IBM_DB2', 1);
define('DB_DC_TYPE_IFX_PEAR', 2);
define('DB_DC_TYPE_DB2_PDO_ODBC', 3);
define('DB_DC_TYPE_IFX_PDO_ODBC', 4);
define('DB_DC_TYPE_DB2_UNIFIED_ODBC', 5);
define('DB_DC_TYPE_IFX_UNIFIED_ODBC', 6);
define('DB_DC_TYPE_MYSQLI', 7);

// The current database connection adapter.
define('DB_DC_TYPE', DB_DC_TYPE_MYSQLI); 

// The current page
define('SELF', $_SERVER['PHP_SELF']);

// The uploads directory
define('UPLOADS_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/uploads_change_after_deploy/');

// The action mapping used by the index controller.
$validPages = array(

	'home' 				=> array('title' => 'Welcome', 'home.php'),
	'about' 			=> array('title' => 'About Us','about.php'),
	'faq' 				=> array('title' => 'Frequently Asked Questions', 'faq.php'),
	'video-guide' 		=> array('title' => 'Video Guide', 'video-guide.php'),
	'help' 				=> array('title' => 'Help', 'help.php'),
	'terms-of-use' 		=> array('title' => 'Terms of Use', 'terms-of-use.php'),
	'contact' 			=> array('title' => 'Contact us', 'contact.php'),
	'press' 			=> array('title' => 'Press', 'press.php'),
	'privacy-policy' 	=> array('title' => 'Privacy Policy', 'privacy-policy.php'),
	'login' 			=> array('title' => 'Login', 'login.php'),
	'logout' 			=> array('title' => 'Logout', 'logout.php'),
	'register' 			=> array('title' => 'Register', 'register.php'),
	'register_test' 	=> array('title' => 'Testing Register', 'register_test.php'),
	'forgot-username' 	=> array('title' => 'Username help', 'forgot-username.php'),
	'forgot-password' 	=> array('title' => 'Password help', 'forgot-password.php'),
	'error' 			=> array('title' => 'Error page', 'error.php'),
	'confirm' 			=> array('title' => 'Registration confirmation', 'confirm.php'),
	'list-all-golfers' 		=> array('title' => 'Active Golfers', 'list-all-golfers.php'),
	'golfer-profile' 		=> array('title' => 'Golfers Personal Profile', 'golfer-profile.php'),
	'golfer-publicprofile'	=> array('title' => 'Golfers Public Profile', 'golfer-publicprofile.php'),
	'edit-golfer-profile' 	=> array('title' => 'Editing Golfers Profile', 'edit-golfer-profile.php'),
	'upload-video' 			=> array('title' => 'Uploading Videos', 'upload-video.php'),	
	'golfer-lessons' 		=> array('title' => 'List of Golfers Lessons', 'golfer-lessons.php'),
	'golfer-videos' 		=> array('title' => 'List of Golfers Uploaded Videos', 'golfer-videos.php'),
	'golfer-video' 			=> array('title' => 'Uploaded Golfer Video', 'golfer-video.php'),
	'submit-golfer-video' 	=> array('title' => 'Submit Video for a Lesson', 'submit-golfer-video.php'),
	'find-a-pro' 			=> array('title' => 'Find a PGA Instructor', 'find-a-pro.php'),
	'list-all-pros' 		=> array('title' => 'List of All Active PGA Instructors', 'list-all-pros.php'),
	'teachpro-profile' 		=> array('title' => 'PGA Teaching Pro Profile', 'teachpro-profile.php'),
	'list-all-golfers' 		=> array('title' => 'Active Golfers', 'list-all-golfers.php'),
	'golfer-profile' 		=> array('title' => 'Golfer Profle', 'golfer-profile.php'),
	'teachpro-profile' 		=> array('title' => 'PGA Teaching Pro Profile', 'teachpro-profile.php'),
	'testing' 				=> array('title' => 'testing', 'testing.php'),
	
);

// Session protected golfer pages
$golferPages = array(
	'edit-golfer-profile' 	=> array('title' => 'Editing Golfers Profile', 'edit-golfer-profile.php'),
	'upload-video' 			=> array('title' => 'Uploading Videos', 'upload-video.php'),	
	'golfer-lessons' 		=> array('title' => 'List of Golfers Lessons', 'golfer-lessons.php'),
	'golfer-videos' 		=> array('title' => 'List of Golfers Uploaded Videos', 'golfer-videos.php'),
	'golfer-video' 			=> array('title' => 'Uploaded Golfer Video', 'golfer-video.php'),
	'submit-golfer-video' 	=> array('title' => 'Submit Video for a Lesson', 'submit-golfer-video.php'),
	'find-a-pro' 			=> array('title' => 'Find a PGA Instructor', 'find-a-pro.php'),
	'list-all-pros' 		=> array('title' => 'List of All Active PGA Instructor', 'list-all-pros.php'),
);

$teachproPages = array(
	//'teachpro-profile' 		=> 'teachpro-profile.php',
);

// Acceptable file upload limit
define('MAX_UPLOAD_SIZE', 15000000);