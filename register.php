<?php
$section_title = Register;
$showForm = true;

if ($_POST['submit_form'] == true){
	
    $errorMsg = array();
    $golfer = new GolferVO();
	
	if(isset($_POST['firstname']) && $_POST['firstname'] != ''){
		$golfer->firstname = ControllerUtilities::sanitizeString($_POST['firstname']);
	} else {
		$errorMsg['firstname'] = 'Please enter First Name.';			
	}

	
	if(isset($_POST['lastname']) && $_POST['lastname'] != ''){
		$golfer->lastname = ControllerUtilities::sanitizeString($_POST['lastname']);
	} else {
		$errorMsg['lastname'] = 'Please enter Last Name.';			
	}
	
	if(isset($_POST['email']) && $_POST['email'] != ''){
		$golfer->email = ControllerUtilities::sanitizeString($_POST['emai']);
	} else {
		 $errorMsg['email'] = 'Please enter Email.';			
	}
	
	if(isset($_POST['screenname']) && $_POST['screenname'] != ''){
		$golfer->screenname = ControllerUtilities::sanitizeString($_POST['screenname']);
	} else {
		 $errorMsg['screenname'] = 'Please enter Screen Name.';			
	}
	
	if(isset($_POST['password']) && $_POST['password'] != ''){
		$golfer->password = ControllerUtilities::sanitizeString($_POST['password']);
		
		if($_POST['password'] != $_POST['confirm_password'] ){

		   $errorMsg['confirm_password'] = "Confirmation Password and Password do not match";	 
		}
		
	} else {
		$errorMsg['password'] = 'Please enter Password.';			
	}
		
	if ( !isset($_POST['agree_to_tc']) ){
			$errorMsg['agree_to_tc'] = 'Please Agree to terms.';
	}
	
	if(sizeof($errorMsg) == 0  ){
		
		$golferMngr = new GolferDAO();
		
		$golfer->id = $golferMngr->processGolferAddition($golfer);
	
		if ($golfer->id) {
			// Set information in the session for this user
			$showForm = false;
		}	
	}
	
	
}
?>
		<!-- Begin Slab ............................................................................. -->					
		<div class="slab">

		<!-- Begin Main Content Table -->	<table cellspacing="0" cellpadding="0" border="0">
					
			<!-- Begin Header -->	<tr>
			<td>
				<!-- Header Table -->
				<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/html/header.php'; ?>	
			</td>
			<!-- End Header --> </tr>
		
			<!-- Begin Body ............................................................................. -->
			<tr>
				<td>
				<!-- Slab Middle ........................................................................ -->
				<div class="slab_middle">
					
<?php 
if ($showForm) { 
?>									
				<!-- Body Table -->	
				<table border="0" cellpadding="0" cellspacing="0" class="body_table">
					<tr>
						<!-- Left Column -->	
						<td valign="top" align="left">
							
							<table width="430" align="left" cellpadding="0" cellspacing="0">
								<!--
								<tr>
									<td>
									<span class="headline">Register</span>
									</td>
								</tr>
								-->
								<tr>
									<td>
						
									<form action="/?action=register" method="post" onsubmit="return validateForm(this);">
									<table border="0" cellpadding="2" cellspacing="5" class="">
										<tr>
											<td width="110"><span class="lightred"></span><span class="darkgreen" id="span_email">First Name:</span></td>											
											<td><input type="text" size="31" class="generic_input" name="firstname" value="<?php echo $_POST['firstname'] ?>"/></td>
										</tr>
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['firstname'] )) {
											echo '<span class="lightred">' . $errorMsg['firstname'] . '</span>';
											}
											?>
											</td>											
											
										</tr>
										<tr>
											<td>
											
											<span class="lightred"></span><span class="darkgreen" id="span_email">Last name:</span></td>
											<td><input type="text" size="31" class="generic_input" name="lastname" value="<?php echo $_POST['lastname'] ?>"/></td>
										</tr>										
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['lastname'] )) {
											echo '<span class="lightred">' . $errorMsg['lastname'] . '</span>';
											}
											?>
											</td>
										</tr>	
										<tr>
											<td><span class="lightred"></span><span class="darkgreen" id="span_email">Email:</span></td>
											<td><input type="text" size="31" class="generic_input" name="email" value="<?php echo $_POST['email'] ?>"/></td>
										</tr>
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['email'] )) {
											echo '<span class="lightred">' . $errorMsg['email'] . '</span>';
											}
											?>
											</td>	
										</tr>
										<tr>
											<td><span class="lightred"></span><span class="darkgreen" id="span_screenname">Screen name:</span></td>
											<td><input type="text" size="31" class="generic_input" name="screenname" value="<?php echo $_POST['screenname'] ?>"/></td>
										</tr>
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['screenname'] )) {
											echo '<span class="lightred">' . $errorMsg['screenname'] . '</span>';
											}
											?>
											</td>
										</tr>
										<tr>
											<td><span class="lightred"></span><span class="darkgreen" id="span_password">Password:</span></td>
											<td><input type="password" size="31" class="generic_input" name="password" value=""/></td>
										</tr>
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['password'] )) {
											echo '<span class="lightred">' . $errorMsg['password'] . '</span>';
											}
											?>
											</td>
										</tr>
										<tr>
											<td><span class="lightred"></span><span class="darkgreen" id="span_confirm_password">Confirm Password:</span></td>
											<td><input type="password" size="31" class="generic_input" name="confirm_password" value=""/></td>
										</tr>
										<tr>
											<td colspan="2">
											<?php if (isset($errorMsg['confirm_password'] )) {
											echo '<span class="lightred">' . $errorMsg['confirm_password'] . '</span>';
											}
											?>
											</td>
										</tr>
										
										<!-- Captcha Image 
										<tr>
											<td><span class="darkgreen">Enter the code in the image:</span></td>
											<td valign="top"><input class="generic_input" type="text" size="31" name="captcha" disabled="disabled" /></td>
										</tr>
										<tr>
											<td></td>
											<td><img class="image_outline" src="/img/turing_test.jpg" height="66" width="175" alt=""/></td>
										</tr>
										 Captcha Image -->
										
										<tr>
											<td>
											<?php if (isset($errorMsg['agree_to_tc'] )){
												echo '<span class="lightred">' . $errorMsg['agree_to_tc'] . '</span>';
											}
											?>
											</td>
											<td>
												<span class="lightred"></span>
												<input type="checkbox" name="agree_to_tc" value="" class="generic_form"/>
												<span class="darkgreen" id="span_agree_to_tc">I agree to the <a href="/?action=terms-of-use"><strong>Terms and Conditions</strong></a>
												and <a href="/?action=privacy-policy"><strong>Privacy Policy</strong></a></span>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
											<input type="submit" class="generic_submit" value="Submit"/>
											<input type="hidden" name="submit_form" value="true" />
											<input class="generic_submit" type="reset" value="Reset" onclick="errorActionReset();" /></td>
										</tr>
									</table>
									</form>
									</td>
								</tr>
							</table>
						</td>

						<td width="10"></td>
						<!-- Right Column -->
						<td align="center" valign="top" class="rightcolumn"> 
							
							<!-- 1st Sidebox -->
							
							<table align="center" cellpadding="0" cellspacing="0" width="332">
								<tr><td class="sidebox_top"></td></tr>
								<tr>
									<td class="sidebox_middle">
										<div class="sidebox_content">
											<span class="sectionhead">Sign In</span>
											<?php
											if (isset($loginErrors)) {
												echo '<span class="lightred">' . $loginErrors . '</span>';
											}
											?>
											<form action="/?action=login" method="post">
											<table border="0" cellpadding="2" cellspacing="5" class="">
												<tr>
													<td><span class="lightred"></span><span class="darkgreen">Username:</span></td>
													<td><input type="text" size="15" class="generic_input" name="screenname" value=""/></td>
												</tr>
												<tr>
													<td><span class="lightred"></span><span class="darkgreen">Password:</span></td>
													<td><input type="password" size="15" class="generic_input" name="password" value=""/></td>
												</tr>
												<tr>
													<td></td>
													<td><input class="generic_submit" type="submit" size="10" name="" value="Submit"/></td>
												</tr>
												<tr>
													<td></td>
													<td class="lightgreensmall">Forgot your <a href="/?action=forgot-username">username</a></td>
												</tr>
												<tr>
													<td></td>
													<td class="lightgreensmall">Forgot your <a href="/?action=forgot-password">password</a></td>
												</tr>
											</table>
											</form>
										</div>
									</td>
								</tr>
								<tr><td class="sidebox_bottom"></td></tr>
							</table>
			
							
						<!-- End Right Column --></td>
						
					</tr>			
				<!-- End Body Table -->
				</table>
<?php 
} else{ 
?> 
				<!-- Body Table -->	
				<table border="0" cellpadding="0" cellspacing="0" class="body_table">
					<tr>
						
						<td valign="top" align="left">
							
							
							<table width="762" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td><span class="title">Thank You!</span></td>
								</tr>
								<tr>
									<td><span class="mediumgreen16">Congratulations <?php echo $golfer->firstname ?> <?php echo $golfer->lastname ?>! Welcome to ViewMySwing.com!</span></td>
								</tr>
								<tr>
									<td><span class="darkgreen">Your account will be confirmed once you respond to the welcome email.</span></td>
								</tr>
								<!-- <tr>
									<td>
									<ul class="actionlist">
									<li><a href="/?action=edit-golfer-profile">Edit your Profile</a></li>
									<li><a href="/?action=upload-video">Upload a Video</a></li>
									<li><a href="/?action=find-a-pro">Find a PGA Teaching Pro</a></li>
									</ul>
									</td>
								</tr> -->
							</table>

						</td>
					</tr>			
				</table>
				<!-- End Body Table -->				
<?php 
}
?> 							
				<br />
				<!-- End Slab Middle -->
				</div>
				</td>
			<!-- End Body --> </tr>

			<!-- Begin Footer ............................................................................. -->
			
			<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/html/footer.php'; ?>
			
			<!-- End Footer -->
		
		<!-- End Main Content Table --> </table>
		
		<!-- End Slab --> </div>


  