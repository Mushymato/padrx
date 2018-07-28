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

$sql = "SELECT `Monsters`.`mID`,
    `Monsters`.`nameEN`,
    `Monsters`.`nameJP`,
    `Monsters`.`ico`,
    `Monsters`.`rarity`,
    `Monsters`.`att1`,
    `Monsters`.`att2`,
    `Monsters`.`type1`,
    `Monsters`.`type2`,
    `Monsters`.`type3`,
    `Monsters`.`hp`,
    `Monsters`.`atk`,
    `Monsters`.`rcv`,
    `Actives`.`name` as `active`,
    `Actives`.`description`,
    `Actives`.`cooldown`,
    `MonsterAwakes`.`m2`,
    `MonsterAwakes`.`m3`,
    `MonsterAwakes`.`m4`,
    `MonsterAwakes`.`m5`,
    `MonsterAwakes`.`m6`,
    `MonsterAwakes`.`m7`,
    `MonsterAwakes`.`m8`,
    `Monsters`.`obtain`
FROM `proticsi_PADR`.`Monsters`
LEFT JOIN `proticsi_PADR`.`Actives` ON `Monsters`.`active`=`Actives`.`actID`
LEFT JOIN `proticsi_PADR`.`MonsterAwakes` ON `Monsters`.`mID`=`MonsterAwakes`.`mID`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><td>mID</td><td>nameEN</td><td>nameJP</td><td>ico</td><td>rarity</td><td>att1</td><td>att2</td><td>type1</td><td>type2</td><td>type3</td><td>hp</td><td>atk</td><td>rcv</td><td>active</td><td>description</td><td>cooldown</td><td>m2</td><td>m3</td><td>m4</td><td>m5</td><td>m6</td><td>m7</td><td>m8</td><td>obtain</td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>". $row["mID"] ."</td><td>". $row["nameEN"] ."</td><td>". $row["nameJP"] ."</td><td>". $row["ico"] ."</td><td>". $row["rarity"] ."</td><td>". $row["att1"] ."</td><td>". $row["att2"] ."</td><td>". $row["type1"] ."</td><td>". $row["type2"] ."</td><td>". $row["type3"] ."</td><td>". $row["hp"] ."</td><td>". $row["atk"] ."</td><td>". $row["rcv"] ."</td><td>". $row["active"] ."</td><td>". $row["description"] ."</td><td>". $row["cooldown"] ."</td><td>". $row["m2"] ."</td><td>". $row["m3"] ."</td><td>". $row["m4"] ."</td><td>". $row["m5"] ."</td><td>". $row["m6"] ."</td><td>". $row["m7"] ."</td><td>". $row["m8"] ."</td><td>". $row["obtain"] ."</td></tr>";
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