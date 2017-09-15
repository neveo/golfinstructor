<table class="slab_top_header" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<!-- Logo -->
		<td align="left" rowspan="2" valign="top">
		<div class="logo_spacing_small"><a href="/"><img src="/img/vmslogo.png" height="83" width="163" border="0" alt=""/></a></div>
		<br />
		<div class="stdtemp_top_title"><span class="title"><?php echo $section_title ?></span></div>
		</td>

		<!-- Top Mini Nav -->
		<td valign="top" align="right">
			<ul class="mini_nav">
				<li><a href="/?action=help">HELP</a></li>
				<?php if (isset($_SESSION['golferId'])) { ?>
				<li><a href="/?action=logout" onclick="return confirmLogout();">LOG OUT</a></li>
				<?php } else { ?>
				<li><a href="/?action=login">LOG IN</a></li>
				<li><a href="/?action=login">JOIN NOW</a></li>
				<?php } ?>
			</ul>
			<br />
	
		<!-- Top Nav --> 
			<div id="stdtemp_nav">
			<ul>
				<li><a href="/?action=list-all-golfers">Golfers</a></li>
				<span><li><a href="/?action=find-a-pro" id="long">Teaching Pros</a></li></span>
				<?php if (isset($_SESSION['golferId'])) { ?>
				<li><a href="/?action=upload-video">Upload</a></li>
				<li><a href="/?action=golfer-profile">Profile</a></li>
				<?php } ?>
			</ul>
			</div>
		</td>
	</tr>
</table>