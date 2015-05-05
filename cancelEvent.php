<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	
	if ($_SESSION['user_login_status'] == 1) {
		require_once('login/config/db.php');
		require_once('classes/Event.php');
		require_once('classes/User.php');
	
		
		
		if (isset($_POST['eventId'])) {
			$event = new Event();
			$event->fetchFrommId($_POST['eventId']);
			
			$user = new Event();
			$user->fetchFromUsername($_SESSION['user_name']);
			
			if ($event->OwnerID == $user->ID) {
				$event->cancelEvent();
				
				if (isset($_POST['source'])) {
					//If source page was specified
					$link = $_POST['source'];
					header("Location: http:$link");
					exit();
				} else {
					//If source page was not specified
					header('Location: default.php');
					exit();
				}
			} else {
				//If user is not owner of event
				exit();
			}
		}
	}
	