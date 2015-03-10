<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
Welcome, <?php echo $_SESSION['user_email']; ?>.

<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<a href="/WhatsGoingOn/login/loginHandler.php?logout">Logout</a>