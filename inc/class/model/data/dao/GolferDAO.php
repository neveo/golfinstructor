<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/UserDAO.php';

/**
* @package    VMS
* @subpackage ModelDataDAO
* @author     Neveo Harrison <code@neveoo.com>
*/
class GolferDAO extends UserDAO  {
	
	public function findGolfer($golferId) 
	{
		return $this->findObject($sql, $params);
	}

	public function insertGolfer($golfer) 
	{
		$userValues = array(
			$golfer->firstname,
			$golfer->lastname,
			$golfer->email,
			$golfer->screenname,
			md5($golfer->password),
			'golfer'
		);	
		
		$this->insertObject('INSERT INTO users (confirmed, firstname, lastname, email, screenname, password, type, created, modified, dob) VALUES ("N", ?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())', $userValues);
		
		$rows = $this->findObject('SELECT id FROM users WHERE email = ?', array($golfer->email));
		foreach ($rows as $row) {
			$this->insertObject('INSERT INTO golfers (user_id) VALUES (?)', array($row['id']));
			return $row['id'];
		}	
		return -1;
	}		
	
	public function updateGolfer($data) 
	{
		return $this->updateObject($sql, $data);
	}
	
	public function deleteGolfer($golferId) 
	{
		return $this->deleteObject($sql, $params);
	}
	
	public function selectGolfer($golferId, $golferEmail = false) 	
	{
		if (!$golferEmail) {
			$rows = $this->findObject('SELECT *, u.id uid FROM users u, golfers g WHERE u.id = g.user_id AND u.id = ?', array($golferId));
		} else {
			$rows = $this->findObject('SELECT *, u.id uid FROM users u, golfers g WHERE u.id = g.user_id AND u.id = ? AND u.email = ?', array($golferId, $golferEmail));
		}
		
		$golfer = null;
		foreach ($rows as $row) {
			$golfer = new GolferVO();
			$golfer->id = $row['uid'];
			$golfer->firstname = $row['firstname'];
			$golfer->lastname = $row['lastname'];
			$golfer->email = $row['email'];
			$golfer->city = $row['city'];
			$golfer->state = $row['state'];
			$golfer->screenname = $row['screenname'];
			$golfer->dob = $row['dob'];
			$golfer->gender = $row['gender'];
			$golfer->handicap = $row['handicap'];
			$golfer->roundsYear = $row['rounds_year'];
			$golfer->aboutMe = $row['about_me'];
			$golfer->emailReceiveUpdate = $row['email_receive_update'];
			$golfer->emailOnTeachpro = $row['email_on_teachpro'];
			$golfer->emailOnComment = $row['email_on_comment'];
		}
		
		$rows = $this->findObject('SELECT * FROM users u, golfclubs gc WHERE u.id = ? AND u.golfclub_id = gc.id', array($golferId));
		foreach ($rows as $row) {
			$golfer->golfclub->name = $row['name'];
			$golfer->golfclub->city = $row['city'];
			$golfer->golfclub->state = $row['state'];
		}		
		
		return $golfer;
	}
	
	public function selectGolfers($features = array()) 
	{
		$filter = '';
		foreach ($features as $key => $value) {
			$filter .= ' AND ' . $key . ' = ?';
		}
		
		$rows = $this->selectObjects('SELECT *, u.id uid FROM users u, golfers g, addresses ad WHERE u.id = g.user_id AND u.id = ad.user_id AND ad.primary = "Y" ' . $filter, $features);
		$golfers = array();
		foreach ($rows as $row) {
			$golfer = new GolferVO();
			$golfer->id = $row['uid'];
			$golfer->screenname = $row['screenname'];
			$golfer->firstname = $row['firstname'];
			$golfer->lastname = $row['lastname'];
			$golfer->city = $row['city'];
			$golfer->state = $row['state'];
			$golfer->about_me = $row['about_me'];
			$golfer->rounds_year = $row['rounds_year'];			
			$golfer->handicap = $row['handicap'];
			$golfer->golfclub->name = $row['name'];
			$golfer->golfclub->city = $row['city'];
			$golfer->golfculb->state = $row['state'];
			$golfers[] = $golfer;
		}
		return $golfers;
	}
	
	public function processGolferAddition($golfer) 
	{
		$id = $this->insertGolfer($golfer);
		//echo $id;
		if ($id != -1) {
			$msg = sprintf("Thank you for creating your ViewMySwing.com account.  You will need to click the link below to confirm your registration before using the site.
	
The information below is the information that will appear on your personal account page.

First name:		%s
Last name:		%s
E-mail: 		%s
Screen name: 		%s

http://localhost/?action=confirm&uid=%s&email=%s
", 
				$golfer->firstname,
				$golfer->lastname,
				$golfer->email,
				$golfer->screenname,
				$id,
				$golfer->email
			);		
			
			$headers =  "From: ViewMySwing.com Support <support@viewmyswing.com>\r\n";
			
			echo $msg;
			
			if (mail($golfer->email, 'Welcome to ViewMySwing.com', $msg, $headers) &&
				mail('neveoo@gmail.com', 'ViewMySwing.com User Registration', $msg, $headers)) {	
				return $id;
			}
		}
		return false;
	}
		
	public function processGolferAdditionConfirmation($golfer) 
	{
		// Select the user id and email to confirm they are a pair
		if ($this->selectGolfer($golfer->id, $golfer->email)) {
			// Update the flag for the user to confirmed
			$this->updateObject('UPDATE users SET confirmed = "Y" WHERE id = ?', array($golfer->id));
			return true;
		}
		return false;
	}	
	
	public function processLogin ($screenname, $password) 
	{
		return parent::processLogin('golfer', $screenname, $password);
	}	
	
	public function processGolferAboutMeUpdate($golfer) 
	{
		$userValues = array(
			$golfer->aboutMe,
			$golfer->id
		);	
			
		if ($this->updateObject('UPDATE golfers SET about_me = ? WHERE user_id = ?', $userValues)) {
			return true;
		}
		return false;
	}
	
	public function processGolferInfoUpdate($golfer) 
	{
		$golferValues = array(
			$golfer->handicap,
			$golfer->roundsYear,
			$golfer->emailReceiveUpdate,
			$golfer->emailOnTeachpro,
			$golfer->emailOnComment,
			$golfer->id,	
		);	
			
		if ($this->updateObject('UPDATE golfers SET handicap = ?, rounds_year = ?, email_receive_update = ?, email_on_teachpro = ?, email_on_comment = ?  WHERE user_id = ?', $golferValues)) {
			return true;
		}
		return false;
	}
	
}