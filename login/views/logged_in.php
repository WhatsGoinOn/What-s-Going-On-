<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>.<br><br>

<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<!--<a href="<?php echo $_SERVER["PHP_SELF"] . "?logout"; ?>">Logout</a>-->
<a href="/WhatsGoingOn/login/logout.php">Logout</a>