<?php
	require_once('../login/config/db.php');
	require_once('../classes/User.php');
	
	if (isset($_POST["upload"])) {
		require_once('../classes/Upload.php');
		$upload = new Upload();
		$upload->uploadImage(1);
		$upload = null;
	}
	
	$userExists = true; //Variable to determine rendering of profile or not
	
	$user = new User();
	if (!empty($_GET["user"])) {
		$user->fetchFromUsername($_GET["user"]);
	} else {
		$userExists = false;
	}
	// show potential errors / feedback (from user object)
	if (isset($user)) {
	    if ($user->errors) {
	        foreach ($user->errors as $error) {
	            //echo $error;
	            $userExists = false;
	        }
	    }
	    if ($user->messages) {
	        foreach ($user->messages as $message) {
	            //echo $message;
	        }
	    }
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On? - Profile</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="../styles/cssMain.css" rel="stylesheet" type="text/css" />		

		<style type="text/css">
			a[href="/WhatsGoingOn/views/userProfile.php"]
			{
				display:block;
				background-color: #E65C00;
				color: #FFFFFF;
				font-weight:bold;
			}
		</style>
	</head>

	<body>
		<div id="wrapper">
		<header>
			<h1><img src="" alt="What's Going On?" /></h1>
			<div id="login">
				<?php require_once("../login/loginHandler.php"); ?> 
			</div>			
		</header>
		<div id="text">
		<nav>
 		 	<?php require_once("../navigation.php"); ?>
	  	</nav>
	  
	  	<section>
	  		<?php
	  		if ($userExists) {
	  			if (isset($_SESSION['user_name']) &&  $_SESSION['user_name'] == $user->Username) {
			?>
			  		<div id="userInfo">
			  			<h1><?php echo($user->Name) ?></h1>
				  		<div class="profileImage">
				  			<?php if ($user->ImageID == null) { ?>
				  				<img class="imgSub" src="../images/avatar.gif" alt="Default Profile Picture">
				  			<?php } else { ?>
				  				<img class="imgSub" src="../image.php?id=<?php echo($user->ImageID) ?>" alt="Profile Picture">
				  			<?php } ?>
				  		</div>
						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="MAX_FILE_SIZE" value="65535">
							<input name="userfile" type="file" id="userfile">
							<input name="upload" type="submit" class="box" id="upload" value=" Upload ">
						</form>
				  		<textarea rows="11" cols="50" placeholder="User Bio"></textarea><br>	
						<input type="button" id="browseImage" value="Select Image" onclick=""/><br>
			  		</div>
			  		
			  		<div id="savedEvents">
			  			<h1>Attending Events</h1>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  		</div>	  		
			  		
		  	<?php } else { ?> <!--If the viewer is not viewing their profile-->
		  			<div id="userInfo">
			  			<h1><?php echo($user->Name) ?></h1>
				  		<div class="profileImage">
				  			<?php if ($user->ImageID == null) { ?>
				  				<img class="imgSub" src="../images/avatar.gif" alt="Default Profile Picture">
				  			<?php } else { ?>
				  				<img class="imgSub" src="../image.php?id=<?php echo($user->ImageID) ?>" alt="Profile Picture">
				  			<?php } ?>
				  		</div>
				  		<p>Bio.</p><br>
			  		</div>
			  		
			  		<div id="savedEvents">
			  			<h1>Attending Events</h1>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  			<div>
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
			  			<h3>Event Name</h3>
			  			</div>
			  		</div>
				<?php }
				} else { ?><!--If username is left off or invalid-->
		  		<p>Invalid user.</p>
		  	<?php } ?>
	  	</section>	  	
	  	</div><!--end of text-->
	  	<footer>
	  		<?php require_once("../footer.php"); ?>
	  	</footer>
	   </div><!--end of wrapper-->	
	</body>
</html>
