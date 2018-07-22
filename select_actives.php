<!DOCTYPE html>
<html>
<style>
form{
	display: block;
	width: 50%;
	margin: auto;
}
.row{
	display: block;
	width: 100%;
}
.column{
	display: block;
	float: left;
	width: 48%;
	padding: 1%;
	vertical-align: center;
}
.left{
	text-align:right;
}
.right{
	text-align:left;
}
button{
	float: right;
	margin: 10pt;
}
</style>
<body>

<form method="post" action="">
<fieldset>
    <legend>Login</legend>
	<div class="row">
		<div class="column left">Username:</div>
		<div class="column right"><input type="text" name="username"></div>
	</div>
	<div class="row">
		<div class="column left">Password: </div>
		<div class="column right"><input type="password" name="password"></div>
	</div>
	<button type="reset" value="Reset">Reset</button>
	<button type="submit" value="Submit">Submit</button>
</fieldset>

<?php 
$servername = "box5570.bluehost.com";
$username = $_POST["username"];
$password = $_POST["password"];

// Create connection
if($username != "" and $password != ""){
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

$sql = "SELECT `Actives`.`actID`,
    `Actives`.`name`,
    `Actives`.`description`,
    `Actives`.`cooldown`
FROM `proticsi_PADR`.`Actives`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><td>actID</td><td>name</td><td>description</td><td>cooldown</td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>". $row["actID"] ."</td><td>". $row["name"] ."</td><td>". $row["description"] ."</td><td>". $row["cooldown"] ."</td></tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
}
?>


</body>
</html>