<?php
require_once "config/config.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID, DateTime, Title, Description FROM event";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><td>ID</td><td>Date/Time</td><td>Title</td><td>Description</td></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"].
			"</td><td>" . $row["DateTime"].
			"</td><td>" . $row["Title"].
			"</td><td>" . $row["Description"]. "</td></tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
