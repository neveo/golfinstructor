<?php
$section_title = "Golfer Profile";

// Check to see if the golfer is looking at his own profile, or whether this is a different user looking a another profile
$isTheLoggedInGolfer = false; 

if (isset($_SESSION['golferId']) && !isset($_GET['golferId'])) {
	$isTheLoggedInGolfer = true;
	$golferId = $_SESSION['golferId'];
} else if (isset($_SESSION['golferId']) && isset($_GET['golferId']) && $_SESSION['golferId'] == $_GET['golferId']) {
	$isTheLoggedInGolfer = true;
	$golferId = $_SESSION['golferId'];
} else {
	$golferId = $_GET['golferId'];
}

// Get videos
$videos = array();
$videoMngr = new VideoDAO();
$videos = $videoMngr->selectVideos($golferId);

// Get the golfer profile
$golferMngr = new GolferDAO();
$golfer = $golferMngr->selectGolfer($golferId);

// Get the golfer photo and attach it to the golfer reference
$photoMngr = new PhotoDAO();
$photoMngr->selectGolferPhoto($golfer);

if ($isTheLoggedInGolfer) {
	// Get the lessons
	$lessons = array();
	$lessonMngr = new LessonDAO();
	$lessons = $lessonMngr->selectLessons($golferId);
	
	// Get the golfer default address
	$addressMngr = new AddressDAO();
	$address = $addressMngr->selectGolferAddress($golferId);
}
echo '<pre>';
//print_r($golfer);
echo '</pre>';
?>
		<!-- Begin Slab ............................................................................. -->					
		<div class="slab">

		<!-- Begin Main Content Table -->	<table cellspacing="0" cellpadding="0" border="0">
					
			<!-- Begin Header -->	
			<tr>
				<td>
				<!-- Header Table -->	
				<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/html/header.php'; ?>
				</td>
			</tr>
			<!-- End Header -->
		
			<!-- Begin Body ............................................................................. -->
			<tr>
				<td>
				<!-- Slab Middle ........................................................................ -->
				<div class="slab_middle">
						
				<!-- Body Table -->	
				<table border="0" cellpadding="0" cellspacing="0" class="body_table">
					<tr>
						<!-- Left Column -->	
						<td valign="top" align="left">
							
							<table width="430" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td colspan="2">
										<span class="mediumgreen16"><?php if ($isTheLoggedInGolfer) { echo 'Welcome ' . $_SESSION['golferScreenname']; } ?></span><br />
										<span class="headline"><?php if ($isTheLoggedInGolfer) { echo $_SESSION['golferFirstname']; } ?> <?php if ($isTheLoggedInGolfer) { echo $_SESSION['golferLastname']; } ?></span>
									</td>
								</tr>
								<tr>
									<td width="385">
										<span class="sectionhead"><?php if ($isTheLoggedInGolfer) { echo 'Your Videos'; } else { echo 'Videos for ' . $golfer->firstname . ' ' . $golfer->lastname; } ?></span>
									</td>
									<td align="right" width="45">
									
										<!-- More link for the rest of the golfer videos.  -->
										
										<div class="little_more"><a href="/?action=golfer-videos&amp;golferId=<?php echo $golfer->id ?>">More...</a></div>
									</td>
								</tr>
<?php
array_splice($videos, 3);
$i = 0;
if ($videos) {
	foreach ($videos as $video) {
?>								
							<?php if ($i % 3 == 0) { ?>
								<tr>
									<td colspan="2">
							<?php } ?>
										
										<div class="photocontainer">
											<div class="photoframe">
												<a href="/?action=golfer-video&id=<?php echo $video->id ?>">
												<!-- Video thumbnails  -->
												<img src="/img/vms_stdtemp_photo_01.jpg" height="111" width="111" alt="" />
												</a>
											</div>
											<span class="darkgreen14"><strong><?php echo $video->title ?></strong></span><br />
											<span class="lightgreen"><?php echo ViewUtilities::displayFormattedDate($video->created) ?><!-- March 3rd, 2007<br />4:43pm --></span>
										</div>
										
										<div class="photospacer_videos"></div>
										
										
							<?php if ($i % 3 == 2) { ?>
									</td>
								</tr>
							<?php } ?>
<?php
		$i++;
	}
} else {
?>
								<tr>
									<td colspan="2"><span class="mediumgreen16">No videos yet.</span><br /><br /></td>
								</tr>
<?php
}
?>
								
								<tr>
									<td>
										<span class="sectionhead"><?php if ($isTheLoggedInGolfer) { echo 'Your Lessons'; } else { echo 'Lessons for ' . $golfer->firstname . ' ' . $golfer->lastname; } ?></span>
									</td>
									<td align="right" width="45">
										<div class="little_more"><a href="/?action=golfer-lessons">More...</a></div>
									</td>
								</tr>
<?php
$i = 0;
if ($lessons) {
	foreach ($lessons as $lesson) {
?>								
							<?php if ($i % 3 == 0) { ?>
								<tr>
									<td colspan="2">
							<?php } ?>
										<div class="photocontainer">
											<div class="photoframe">
												<a href="/?action=golfer-video&id=<?php echo $lesson->id ?>">
												<img src="/img/vms_stdtemp_photo_01.jpg" height="111" width="111" alt="" />
												</a>
											</div>
											<span class="darkgreen14"><strong><?php echo $lesson->title ?></strong></span><br />
											<span class="lightgreen"><?php echo ViewUtilities::displayFormattedDate($lesson->created) ?><!-- March 3rd, 2007<br />4:43pm --></span>
										</div>
							<?php if ($i % 3 == 2) { ?>
									</td>
								</tr>
							<?php } ?>
<?php
		$i++;
	}
} else {
?>
								<tr>
									<td colspan="2"><span class="mediumgreen16">No lessons yet.</span><br /><br /></td>
								</tr>
<?php
}
?>								
							</table>

						</td>
						
						<!-- Right Column -->
						<td align="center" valign="top">
							
							<!-- 1st Sidebox -->
							<div class="rightcolumn">
							
							<?php if ($isTheLoggedInGolfer) { ?>
							<table width="332" align="center" cellpadding="0" cellspacing="0">
								<tr><td class="sidebox_top"></td></tr>
								<tr>
									<td class="sidebox_middle">
										<div class="sidebox_content">
											<span class="sectionhead">Welcome to View My Swing</span>
											<span class="mediumgreen">
											Thanks for registering with us. View My Swing is here to connect you with Professional 
											Golfer Association class A Teaching Pros. This is your homepage where you can upload your 
											videos to have them analyzed by our pros.
											</span>
										</div>
									</td>
								</tr>
								<tr><td class="sidebox_bottom"></td></tr>
							</table>
							<?php } ?>
							
							<!-- 2nd Sidebox -->
							<table align="center" cellpadding="0" cellspacing="0" width="332">
								<tr><td class="sidebox_top"></td></tr>
								<tr>
									<td class="sidebox_middle">
										<div class="sidebox_content">
											<span class="sectionhead">Profile Information</span>
											<div class="photocontainer">
												<div class="photoframe_nolink">
												<img src="/view-photo.php?photo=<?php echo $golfer->photo->photo ?>&amp;golferId=<?php echo $golfer->id ?>" height="111" width="111" alt="" /></div>
											</div>
											<ul class="profile_stats">
												<li><strong><span class="darkgreen14">Rounds Per Year:</span></strong><br /><?php echo $golfer->roundsYear ?></li>
												<li><strong><span class="darkgreen14">Handicap Index:</span></strong><br /><?php echo ViewUtilities::displayFormattedHandicap($golfer->handicap) ?></li>
												<li><strong><span class="darkgreen14">Age:</span></strong><br /><?php echo ViewUtilities::displayFormattedAge($golfer->dob) ?></li>
												<li><strong><span class="darkgreen14">Club Affiliation:</span></strong><br /><?php echo $golfer->golfclub->name ?>, <?php echo $golfer->golfclub->city ?>, <?php echo $golfer->golfclub->state ?></li>
											</ul>
										</div>
									</td>
								</tr>
								<tr><td class="sidebox_bottom"></td></tr>
							</table>
							
							
							<?php if ($isTheLoggedInGolfer) { ?>
							<!-- 3rd Sidebox -->
							<table width="332" align="center" cellpadding="0" cellspacing="0">
								<tr><td class="sidebox_top"></td></tr>
								<tr>
									<td class="sidebox_middle">
										<div class="sidebox_content">
											<span class="sectionhead">Let's Start!</span>
											<ul class="actionlist">
												<li><a href="/?action=edit-golfer-profile">Edit Your Profile</a></li>
												<li><a href="/?action=upload-video">Upload a Video</a></li>
												<li><a href="/?action=find-a-pro">Find a PGA Teaching Pro</a></li>
												<li><a href="/?action=submit-golfer-video">Send a Video to a Teaching Pro</a></li>
											</ul>
										</div>
									</td>
								</tr>
								<tr><td class="sidebox_bottom"></td></tr>
							</table>
							<?php } ?>
							
							</div>
						<!-- End Right Column --></td>
						
					</tr>			
				<!-- End Body Table -->
				</table>

				<!-- End Slab Middle -->
				</div>
				</td>
			<!-- End Body --> </tr>

			<!-- Begin Footer ............................................................................. -->
			
			<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/html/footer.php'; ?>
			
			<!-- End Footer --> 
		
		<!-- End Main Content Table --> </table>
		
		<!-- End Slab --> </div>