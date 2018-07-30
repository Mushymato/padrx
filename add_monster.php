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
</fieldset>
</br>
</br>
<fieldset>
    <legend>Monster</legend>
	<input type="radio" name="mode" value="add" checked>Add <input type="radio" name="mode" value="edit">Edit
	<div class="row">
		<div class="column left">mID: </div>
		<div class="column right"><input type="text" name="mID"></div>
	</div>
	<div class="row">
		<div class="column left">nameEN: </div>
		<div class="column right"><input type="text" name="nameEN"></div>
	</div>
	<div class="row">
		<div class="column left">nameJP: </div>
		<div class="column right"><input type="text" name="nameJP"></div>
	</div>
	<div class="row">
		<div class="column left">ico: </div>
		<div class="column right"><input type="text" name="ico"></div>
	</div>
	<div class="row">
		<div class="column left">rarity: </div>
		<div class="column right"><select name="rarity">
			<option value="10">10</option>
			<option value="9">9</option>
			<option value="8">8</option>
			<option value="7">7</option>
			<option value="6">6</option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select></div>
	</div>
	<div class="row">
		<div class="column left">attributes: </div>
		<div class="column right"><select name="att1">
			<option value="1">Fire</option>
			<option value="2">Water</option>
			<option value="3">Wood</option>
			<option value="4">Light</option>
			<option value="5">Dark</option>
		</select></br><select name="att2">
			<option value="NULL"></option>
			<option value="1">Fire</option>
			<option value="2">Water</option>
			<option value="3">Wood</option>
			<option value="4">Light</option>
			<option value="5">Dark</option>
		</select></div>
	</div>
	<div class="row">
		<div class="column left">types: </div>
		<div class="column right"><select name="type1">
			<option value="1">Dragon</option>
			<option value="2">Balanced</option>
			<option value="3">Physical</option>
			<option value="4">Healer</option>
			<option value="5">Attacker</option>
			<option value="6">God</option>
			<option value="7">Devil</option>
			<option value="8">Machine</option>
			<option value="9">Evo</option>
			<option value="10">Enhance</option>
			<option value="11">Awoken</option>
			<option value="12">Vendor</option>
		</select></br><select name="type2">
			<option value="NULL"></option>
			<option value="1">Dragon</option>
			<option value="2">Balanced</option>
			<option value="3">Physical</option>
			<option value="4">Healer</option>
			<option value="5">Attacker</option>
			<option value="6">God</option>
			<option value="7">Devil</option>
			<option value="8">Machine</option>
			<option value="9">Evo</option>
			<option value="10">Enhance</option>
			<option value="11">Awoken</option>
			<option value="12">Vendor</option>
		</select></div>
	</div>
	<div class="row">
		<div class="column left">hp: </div>
		<div class="column right"><input type="text" name="hp"></div>
	</div>
	<div class="row">
		<div class="column left">atk: </div>
		<div class="column right"><input type="text" name="atk"></div>
	</div>
	<div class="row">
		<div class="column left">rcv: </div>
		<div class="column right"><input type="text" name="rcv"></div>
	</div>
	<div class="row">
		<div class="column left">active: </div>
		<div class="column right"><input type="text" name="active"></div>
	</div>
	<div class="row">
		<div class="column left">description: </div>
		<div class="column right"><input type="text" name="description"></div>
	</div>
	<div class="row">
		<div class="column left">cooldown: </div>
		<div class="column right"><input type="text" name="cooldown"></div>
	</div>
	<div class="row">
		<div class="column left">Awakes: </div>
		<div class="column right">
		N: <select name="N">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select> 
		R: <select name="R">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select> 
		SR: <select name="SR">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select> 
		UR: <select name="UR">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select></div>
	</div>
	<div class="row">
		<div class="column left">obtain: </div>
		<div class="column right"><input type="text" name="obtain"></div>
	</div>

</fieldset>

	<button type="reset" value="Reset">Reset</button>
	<button type="submit" value="Submit">Submit</button>
</form>
<?php
function update_tbl_mID($conn, $table, $column, $mID, $value){
	echo "UPDATE `proticsi_PADR`.`" . $table . "` SET `". $column . "`=? WHERE `mID`=?;</br>";
	$update_value = $conn->prepare("UPDATE `proticsi_PADR`.`" . $table . "` SET `". $column . "`=? WHERE `mID`=?;");
	if(!$update_value){
		die("Update " . $table . " failed: " . $conn->error . ".</br>");
	}
	$update_value->bind_param("ss", $value, $mID);
	if($update_value->execute()){
		echo "Changed " . $column . " of " . $mID . " to " . $value . "</br>";
	}else{
		die("Update " . $table . " failed: " . $conn->error . ".</br>");
	}
	$update_value->close();
}

function update_tbl_active($conn, $column, $name, $value){
	$update_value = $conn->prepare("UPDATE `proticsi_PADR`.`Actives` SET `". $column . "`=? WHERE `name`=?;");
	if(!$update_value){
		die("Update " . $table . " failed: " . $conn->error . ".</br>");
	}
	$update_value->bind_param("ss", $value, $name);
	if($update_value->execute()){
		echo "Changed " . $column . " of " . $name . " to " . $value . "</br>";
	}else{
		die("Update Actives failed: " . $conn->error . ".</br>");
	}
	$update_value->close();
}


$servername = "box5570.bluehost.com";
$username = $_POST["username"];
$password = $_POST["password"];

if($username != "" and $password != ""){
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	echo "Connected successfully</br>";
	
	if($_POST["mode"] == "add"){
		// prepare statements
		$insert_active = $conn->prepare("INSERT INTO `proticsi_PADR`.`Actives` (`actID`,`name`,`description`,`cooldown`) VALUES(default,?,?,?);");
		$insert_active->bind_param("ssi", $active, $description, $cooldown);
		$select_active = $conn->prepare("SELECT actID FROM `proticsi_PADR`.`Actives` WHERE `Actives`.`name`=?;");
		$select_active->bind_param("s", $active);
		$select_active->bind_result($actID_res);
		
		$insert_monster = $conn->prepare("INSERT INTO `proticsi_PADR`.`Monsters` (`nameEN`,`nameJP`,`ico`,`rarity`,`att1`,`att2`,`type1`,`type2`,`hp`,`atk`,`rcv`,`active`,`obtain`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$insert_monster->bind_param("sssissssiiiis", $nameEN, $nameJP, $ico, $rarity, $att1, $att2, $type1, $type2, $hp, $atk, $rcv, $actID, $obtain);
		$select_monster = $conn->prepare("SELECT mID FROM `proticsi_PADR`.`Monsters` WHERE `Monsters`.`nameJP`=?;");
		$select_monster->bind_param("s", $nameJP);
		$select_monster->bind_result($mID_res);

		$insert_awakes = $conn->prepare("INSERT INTO `proticsi_PADR`.`MonsterAwakes`(`mID`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`) VALUES (?,?,?,?,?,?,?,?);");
		$insert_awakes->bind_param("iiiiiiii", $mID, $m2, $m3, $m4, $m5, $m6, $m7, $m8);
		
		// insert active
		$active = $_POST["active"];
		$description = $_POST["description"];
		$cooldown = $_POST["cooldown"];
		if($insert_active->execute()){
			echo "Add " . $active . " sucess.</br>";
		}else{
			echo "Add " . $active . " failed: " . $conn->error . ".</br>";
		}
		$insert_active->close();
		
		// get new actID
		if($select_active->execute() and $select_active->fetch()){
			echo "Got actID: " . $actID_res . ".</br>";
			$actID = $actID_res;
		}else{
			die("Get actID failed: " . $conn->error . ".</br>");
		}
		$select_active->close();

		// insert monster
		$nameEN = $_POST["nameEN"];
		$nameJP = $_POST["nameJP"];
		$ico = $_POST["ico"];
		$rarity = $_POST["rarity"];
		$att1 = $_POST["att1"];
		$att2 = ($_POST["att2"] == "NULL" ? null : $_POST["att2"]);
		$type1 = $_POST["type1"];
		$type2 = ($_POST["type2"] == "NULL" or $_POST["type1"] == $_POST["type2"] ? null : $_POST["type2"]);
		$hp = $_POST["hp"];
		$atk = $_POST["atk"];
		$rcv = $_POST["rcv"];
		$obtain = $_POST["obtain"];
		if($insert_monster->execute()){
			echo "Add " . $nameEN . " sucess.</br>";
		}else{
			echo "Add " . $nameEN . " failed: " . $conn->error . ".</br>";
		}
		$insert_monster->close();
		// get new mID
		$select_monster = $conn->prepare("SELECT mID FROM `proticsi_PADR`.`Monsters` WHERE `Monsters`.`nameJP`=?;");
		$select_monster->bind_param("s", $nameJP);
		$select_monster->bind_result($mID_res);
		if($select_monster->execute() and $select_monster->fetch()){
			echo "Got mID: " . $mID_res . ".</br>";
			$mID = $mID_res;
		}else{
			die("Get mID failed: " . $conn->error . ".</br>");
		}
		$select_monster->close();

		$insert_awakes = $conn->prepare("INSERT INTO `proticsi_PADR`.`MonsterAwakes`(`mID`,`N`,`R`,`SR`,`UR`) VALUES (?,?,?,?,?);");
		$insert_awakes->bind_param("iiiiiiii", $mID, $n, $r, $sr, $ur);
		$n = $_POST["N"];
		$n = $_POST["R"];
		$n = $_POST["SR"];
		$n = $_POST["UR"];

		if($insert_awakes->execute()){
			echo "Add " . $nameEN . " awakes sucess.</br>";
		}else{
			die("Add " . $nameEN . " awakes failed: " . $conn->error . ".</br>");
		}
		$insert_awakes->close();
		$conn->close();
	}else if($_POST["mode"] == "edit"){
		$monsters_col = array("nameEN","nameJP","ico","rarity","att1","att2","type1","type2","hp","atk","rcv","obtain");
		$actives_col = array("active","description","cooldown");
		$awakes_col = array("m2","m3","m4","m5","m6","m7","m8");
		
		$mID = $_POST["mID"];
		
		if($mID != ""){
			foreach ($monsters_col as $col){
				$value = $_POST[$col];
				if($value != "" or $value == "NULL"){
					$value = ($value = "NULL" ? null : $value);
					update_tbl_mID($conn, "Monsters", $col, $mID, $value);
				}
			}
					
			foreach ($awakes_col as $col){
				$value = $_POST[$col];
				if($value != "" or $value == "NULL"){
					update_tbl_mID($conn, "MonsterAwakes", $col, $mID, $value);
				}else{
					break;
				}
			}
		}
		$name = $_POST["active"];
		if($name != ""){
			foreach ($awakes_col as $col){
				$value = $_POST[$col];
				if($value != "" or $value == "NULL"){
					update_tbl_active($conn, "MonsterAwakes", $col, $name, $value);
				}else{
					break;
				}
			}
			if($miD != ""){
				$select_active = $conn->prepare("SELECT actID FROM `proticsi_PADR`.`Actives` WHERE `Actives`.`name`=?;");
				$select_active->bind_param("s", $active);
				$select_active->bind_result($actID_res);
				
				if($select_active->execute() and $select_monster->fetch()){
					update_tbl_mID("Monsters", "active", $mID, $actID_res);
				}else{
					die("Get actID failed: " . $conn->error . ".</br>");
				}
			}
		}
	}
}else{
	echo "Hello.";
}
?>

</body>
</html>