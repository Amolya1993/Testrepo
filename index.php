<?php

# We will include this file to connect with database.
include('database_connection.php'); 

# If using session, uncomment below line
/*session_start();*/

# If using session, uncomment below line

/*if(!isset($_SESSION['user_email'])) {
	header('location: login.php');
}*/

#If cookie is not set (or expired after 1 hour), redirect to login page.
if(!isset($_COOKIE['user_email'])) {
	header('location: login.php');
}

if(isset($_GET['logout'])) {
	
	# If using session, uncomment below line
	/* session_unset();
	 session_destroy();*/
	
	setcookie("user_email", $email, time() + 0);
	
	# Redirect to login.php page
	header('location: login.php');
}
?>

<html>
<head>
<title>PHP Login Sample</title>
</head>
<body>

<div align="right">
<a href="?logout">Logout</a>
</div>

<?php
if(isset($_COOKIE['user_email'])) {
	$email = $_COOKIE['user_email'];
	echo'<h2 align="center"> Welcome '.$email.'</h2>';
}
?>
<br><br>

<h2 align="center"> List of users </h2>
<table border="2" align="center">
<tr>
<th>Username</th>
<th>Email</th>
<th>Address</th>
<th>Action</th>
</tr>
<?php
	$user_query = "select * from users";
	$result = mysqli_query($con, $user_query);
	while($row = mysqli_fetch_array($result)) {
		echo '<tr>';
		echo '<td>'; echo $row["user_name"]; echo '</td>';
		echo '<td>'; echo $row["user_email"] ; echo '</td>';
		echo '<td>'; echo $row["user_address"]; echo '</td>';
		echo '<td>'; echo '<a href="operation.php?action=delete&email='.$row["user_email"].'">Delete</a>'; echo '&nbsp;&nbsp;&nbsp;'; echo '<a href="operation.php?action=update&email='.$row["user_email"].'">Update</a>';
		echo '</td>';
		echo '</tr>';
	}
?>
</table>

<br><br><br>
<div align="center">
<a href="operation.php?action=insert">Insert User</a>; 
<br>
<a href="operation.php?action=search">Search User</a>; 
</div>
</body>
</html>