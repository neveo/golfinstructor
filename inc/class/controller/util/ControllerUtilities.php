<?php
/**
* This class provides a namespace for the static functions which are used by the ViewMySwing controller.
* @package    VMS
* @subpackage ControllerUtil
* @author     Neveo Harrison <code@neveoo.com>
*/
class ControllerUtilities {
	
	/**
	* The private constructor to ensure that this class is only used statically.
	*/	
	private function __construct() {}
	
	/**
	* Filter user supplied parameters for the action.
	* 
	* @param string $action The action parameter to clean.
	* @static 
	* @return string The cleaned up value.
	*/	
	public static function sanitizeAction($action) 
	{
		if (trim($action === '') || $action == null) {
			return 'home';
		} else {
			return ControllerUtilities::sanitizeString($action);
		}
	}
	
	/**
	* Filter user supplied strings, allow for hypens and spaces.
	* 
	* @param string $string The string to clean.
	* @static 
	* @return string The cleaned up value.
	*/		
	public static function sanitizeString($string) 
	{	
		if (!ctype_alpha(str_replace('-', '', str_replace(' ', '', $string)))) {
			//die('The string was not a string: ' . $string);
			return 'register';
		} else {
			return trim($string);
		}
	}
	
	/**
	* Filter user supplied numbers.
	* 
	* @param string $number The number to verify.
	* @static 
	* @return int The verified number.
	*/		
	public static function sanitizeNumber($number) 
	{	
		if (!ctype_digit(trim($number))) {
			die('The number was not a number: ' . $number);
		} else {
			return trim($number);
		}
	}
	
	/**
	* Filter user supplied numbers.
	* 
	* @todo Implement logic.
	* @param string $value The value to verify.
	* @static 
	* @return string The verified value.
	*/		
	public static function sanitizeValue($value) 
	{	
		//if (!ctype_alnum($value)) {
		//	die('The value was not alphanumeric');
		//} else {
			return trim($value);
		//}
	}
	
	/**
	* Filter user supplied email address.
	* TODO: Implement logic.
	*/
	/**
	* Filter user supplied parameters for the action.
	* 
	* @param string $action The action parameter to prepare.
	* @static 
	* @return string The sanitized email address.
	*/		
	public static function sanitizeEmail($email) 
	{	
		return strtolower(trim($email));
	}
	
	/**
	* Create a session for this user.
	* 
	* @param string $id The id to store in the session.
	* @param string $email The email to store in the session.
	* @param string $type Whether a customer or the dealer.
	* @static 
	* @return void
	*/		
	public static function createSession($user, $type) 
	{	
		ControllerUtilities::resetSession($type);
		if ($type == 'golfer') {
			$_SESSION['golferId'] = $user->id;
			$_SESSION['golferFirstname'] = $user->firstname;
			$_SESSION['golferLastname'] = $user->lastname;
			$_SESSION['golferEmail'] = $user->email;
			$_SESSION['golferScreenname'] = $user->screenname;	
		} else {
			$_SESSION['teachproId'] = $user->id;
			$_SESSION['teachproFirstname'] = $user->firstname;
			$_SESSION['teachproLastname'] = $user->lastname;
			$_SESSION['teachproEmail'] = $user->email;
			$_SESSION['teachproScreenname'] = $user->screenname;	
		}
	}
	
	/**
	* Check to see whether the file uploaded is in the proper format.
	* 
	* @param string $file The file to check for validity.
	* @static 
	* @return bool Whether the upload was valid.
	*/		
	public static function validateFileUpload($file) 
	{	
		if ($file['size'] === 0 || $file['size'] > MAX_UPLOAD_SIZE || !$file['name']) {
			echo 'File size or name was incorrect';
			return false;
		} 
		
		//destination of the moved file
		$fileName = 'uploads_change_after_deploy' . DIRECTORY_SEPARATOR . $_SESSION['golferId'] . '_-_-_' . basename($file['name']);
		
		if (!move_uploaded_file($file['tmp_name'], $fileName)) {
			echo 'Couldn\'t move the file';
			echo $fileName;
			return false;
		}
		
		return $fileName;
	}	
	
	/**
	* Checks that a valid session exists.
	* 
	* @param string $type Whether a customer or the dealer.
	* @param string $redirect Whether to redirect to the login page.
	* @static 
	* @return bool Whether a valid session exists.
	*/		
	public static function checkSession($type, $redirect = false) 
	{	
		//print_r($_SESSION);
		if (!isset($_SESSION[$type . 'Id']) && $redirect) {
			return true;
			//header('Location: /?action=login');
			//exit;
		} else if (isset($_SESSION[$type . 'Id']) && isset($_GET['action']) && $_GET['action'] != 'logout') {
			return true;
		} else if (isset($_GET['action']) && ($_GET['action'] == 'login' || $_GET['action'] == 'register') && isset($_POST[$type . 'Email'])) {
			return true;
		} else if (!isset($_SESSION[$type . 'Id'])) {
			return false;			
		}
		return false;
	}	
	
	/**
	* Destroy the session.
	* 
	* @static 
	* @return void
	*/		
	public static function destroySession() 
	{	
		session_unset();
		session_destroy();
	}
		
	/**
	* Create a session for this user.
	* 
	* @param string $id The id to store in the session.
	* @param string $email The email to store in the session.
	* @param string $type Whether a customer or the dealer.
	* @static 
	* @return void
	*/		
	public static function resetSession($type) 
	{	
		if ($type == 'golfer') {
			unset($_SESSION['golferId']);
			unset($_SESSION['golferFirstname']);
			unset($_SESSION['golferLastname']);
			unset($_SESSION['golferEmail']);
			unset($_SESSION['golferScreenname']);
		} else {
			unset($_SESSION['teachproId']);
			unset($_SESSION['teachproFirstname']);
			unset($_SESSION['teachproLastname']);
			unset($_SESSION['teachproEmail']);
			unset($_SESSION['teachproScreenname']);	
		}
	}	
	
}