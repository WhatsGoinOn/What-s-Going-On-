<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	require_once('../login/config/db.php');
	require_once('../classes/User.php');
	require_once("../classes/Event.php");
	require_once("../classes/Events.php");
	
	if (isset($_POST["upload"])) {
		require_once('../classes/Upload.php');
		$upload = new Upload();
		$upload->uploadImage(1);
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
	    } else {
	    	//Search for events the user owns
	    	$events = new Events();
			$events->searchOwned($user->ID);
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
							<?php
							// show potential errors / feedback (from upload object)
							if (isset($upload)) {
							    if ($upload->errors) {
							    	echo '<p class="error">';
							        foreach ($upload->errors as $error) {
							            echo $error;
							        }
									echo '</p>';
							    }
							    if ($upload->messages) {
							    	echo '<p class="message">';
							        foreach ($login->messages as $message) {
							            echo $message;
							        }
									echo '</p>';
							    }
							}
							?>
							<input type="hidden" name="MAX_FILE_SIZE" value="65535">
							<label for="userfile">Upload profile photo (max 63KB):</label>
							<input name="userfile" type="file" id="userfile"><br/>
							<input name="upload" type="submit" id="upload" value="Upload">
						</form>
						<form method="post">
					  		<textarea rows="11" cols="50" placeholder="User Bio"><?php echo($user->Bio); ?></textarea><br/>
							<input name="updateBio" type="submit" id="upload" value="Update Bio">
						</form>
			  		</div>
			  		
			  		<h1>Owned Events</h1>
			  		<section id="searchList">
						<?php
							if (isset($events) && $events->getCount() > 0) {
								//Display events
								for ($i = 0; $i < $events->getCount(); $i++) {
									$event = $events->getItem($i);
									$event->displayOwnedEventItem();
									
								}
							} else {
								echo("<p>You own no events.</p>");
							}
						?>
				  	</section>  		
			  		
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
				  		<p><?php echo($user->Bio); ?></p><br>
			  		</div>
			  		
			  		<h1>Owned Events</h1>
			  		<section id="searchList">
						<?php
							if (isset($events) && $events->getCount() > 0) {
								//Display events
								for ($i = 0; $i < $events->getCount(); $i++) {
									$event = $events->getItem($i);
									$event->displayEventItem();
									
								}
							} else {
								echo("<p>This user owns no events.</p>");
							}
						?>
				  	</section>
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
