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
	<div class="row">
		<div class="column left">Search for: </div>
		<div class="column right"><select name="search_col">
			<option value="nameJP">nameJP</option>
			<option value="nameEN">nameEN</option>
			<option value="active">active</option>
			<option value="description">active description</option>
		</select> <input type="text" name="search_val"></div>
	</div>
	<div class="row">
		<div class="column left">Filter by: </div>
		<div class="column right"><select name="filter_col">
			<option value="att">attribute</option>
			<option value="type">type</option>
			<option value="awakes">awakes</option>
		</select> <input type="text" name="filter_val"></div>
	</div>
	<div class="row">
		<div class="column left">Order By: </div>
		<div class="column right"><select name="order_col">
			<option value="nameJP">nameJP</option>
			<option value="nameEN">nameEN</option>
			<option value="ico">ico</option>
			<option value="rarity">rarity</option>
			<option value="att">attribute</option>
			<option value="type">type</option>
			<option value="hp">hp</option>
			<option value="atk">atk</option>
			<option value="rcv">rcv</option>
			<option value="active">active</option>
			<option value="description">description</option>
			<option value="cooldown">cooldown</option>
			<option value="N">N</option>
			<option value="R">R</option>
			<option value="SR">SR</option>
			<option value="UR">UR</option>
		</select> <select name="asc_desc">
			<option value="ASC">ASC</option>
			<option value="DESC">DESC</option>
		</select></div>
	</div>
	<button type="reset" value="Reset">Reset</button>
	<button type="submit" value="Submit">Submit</button>
</fieldset>

<?php 

function get_att($att_id){
	$url = "https://i1.wp.com/pad.protic.site/wp-content/uploads/pad-orbs/";
	return $att_id == null ? "" : "<img src=\"$url$att_id.png\">";
}

function get_type($type_id){
	$url = "https://i1.wp.com/pad.protic.site/wp-content/uploads/pad-types/";
	return $type_id == null ? "" : "<img src=\"$url$type_id.png\">";
}

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
		`MonsterAwakes`.`N`,
		`MonsterAwakes`.`R`,
		`MonsterAwakes`.`SR`,
		`MonsterAwakes`.`UR`,
		`Monsters`.`obtain`
	FROM `proticsi_PADR`.`Monsters`
	LEFT JOIN `proticsi_PADR`.`Actives` ON `Monsters`.`active`=`Actives`.`actID`
	LEFT JOIN `proticsi_PADR`.`MonsterAwakes` ON `Monsters`.`mID`=`MonsterAwakes`.`mID`";

	if($_POST["search_val"] != ""){
		$sql = $sql . " WHERE " . $_POST['search_col'] . " like ?";
		$param = "%" . $_POST["search_val"] . "%";
	}
	if(isset($_POST["order_col"])){
		if($_POST["order_col"] == "att"){
			$sql = $sql . " ORDER BY att1, att2";
		}else if($_POST["order_col"] == "type"){
			$sql = $sql . " ORDER BY type1, type2, type3";
		}else{
			$sql = $sql . " ORDER BY " . $_POST['order_col'];
		}
	}
	if(isset($_POST['asc_desc'])){
		$sql = $sql . " " . $_POST['asc_desc'] . ";";
	}
	

	$select_monster = $conn->prepare($sql);
	$select_monster->bind_param('s', $param);
	$select_monster->bind_result($mID, $nameEN, $nameJP, $ico, $rarity, $att1_id, $att2_id, $type1_id, $type2_id, $type3_id, $hp, $atk, $rcv, $active, $description, $cooldown, $N, $R, $SR, $UR, $obtain);
	if(!$select_monster->execute()){
		die("Select monster memory failed: " . $conn->error . ".</br>");
	}
	
	echo "<table><tr><td>mID</td><td>nameEN</td><td>nameJP</td><td>ico</td><td>rarity</td><td>att1</td><td>att2</td><td>type1</td><td>type2</td><td>type3</td><td>hp</td><td>atk</td><td>rcv</td><td>active</td><td>description</td><td>cooldown</td><td>N</td><td>R</td><td>SR</td><td>UR</td><td>obtain</td></tr>";
	// output data of each row
	while($select_monster->fetch()) {
		$att1 = get_att($att1_id);
		$att2 = get_att($att2_id);
		$type1 = get_type($type1_id);
		$type2 = get_type($type2_id);
		$type3 = get_type($type3_id);

		echo "<tr><td>$mID</td><td>$nameEN</td><td>$nameJP</td><td><img src=\"$ico\"></td><td>$rarity</td><td>$att1</td><td>$att2</td><td>$type1</td><td>$type2</td><td>$type3</td><td>$hp</td><td>$atk</td><td>$rcv</td><td>$active</td><td>$description</td><td>$cooldown</td><td>$N</td><td>$R</td><td>$SR</td><td>$UR</td><td>$obtain</td></tr>";
	}
	echo "</table>";
	$conn->close();
}
?>


</body>
</html>