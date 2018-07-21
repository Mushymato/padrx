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

<?php
$servername = 'box5570.bluehost.com';
$username = _POST['username'];
$password = _POST['password'];

if($username != '' and $password != ''){
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die('Connection failed: ' . $conn->connect_error);
	} 

	echo 'Connected successfully';
	
	if(_POST['mode'] == 'add'){
		$insert_active = $conn->prepare('INSERT INTO `proticsi_PADR`.`Actives` (`actID`,`name`,`description`,`cooldown`) VALUES(default,?,?,?);');
		$insert_active->bind_param('ssi', $active, $description, $cooldown);
		$select_active = $conn->prepare('SELECT actID FROM `proticsi_PADR`.`Actives` WHERE `Actives`.`name`=?;');
		$select_active->bind_param('s', $active);
		
		$active = _POST['active'];
		$description = _POST['description'];
		$cooldown = _POST['cooldown'];
		
		$insert_active->execute();
		$res = $select_active->execute();

		$insert_monster = $conn->prepare('INSERT INTO `proticsi_PADR`.`Monsters` (`mID`,`nameEN`,`nameJP`,`ico`,`rarity`,`att1`,`att2`,`type1`,`type2`,`type3`,`hp`,`atk`,`rcv`,`active`,`obtain`) VALUES(default,?,?,?,?,?,?,?,?,NULL,?,?,?,?,?);');
		$select_monster = $conn->prepare('SELECT actID FROM `proticsi_PADR`.`Monsters` WHERE `Actives`.`nameJP`=?;');
		$select_active->bind_param('s', $nameJP);
		$insert_monster->bind_param('sssisssssiiiis', $nameEN, $nameJP, $ico, $rarity, $att1, $att2, $type1, $type2, $hp, $atk, $rcv, $actID, $obtain);
		
		$nameEN = _POST['nameEN'];
		$nameJP = _POST['nameJP'];
		$ico = _POST['ico'];
		$rarity = _POST['rarity'];
		$att1 = _POST['att1'];
		$att2 = _POST['att2'];
		$type1 = _POST['type1'];
		$type2 = _POST['type2'];
		$hp = _POST['hp'];
		$atk = _POST['atk'];
		$rcv = _POST['rcv'];
		$obtain = _POST['obtain'];
		$actID = ($res->fetch_assoc())['actID'];
		
		$insert_monster->execute();
		$res = $select_monster->execute();
		
		$insert_awakes = $conn->prepare('INSERT INTO `proticsi_PADR`.`MonsterAwakes`(`mID`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`) VALUES (?,?,?,?,?,?,?,?);');
		$insert_awakes->bind_param('iiiiiiii', $mID, $m2, $m3, $m4, $m5, $m6, $m7, $m8);
		$mID = ($res->fetch_assoc())['mID'];
		$m2 = ($res->fetch_assoc())['m2'];
		$m3 = ($res->fetch_assoc())['m3'];
		$m4 = ($res->fetch_assoc())['m4'];
		$m5 = ($res->fetch_assoc())['m5'];
		$m6 = ($res->fetch_assoc())['m6'];
		$m7 = ($res->fetch_assoc())['m7'];
		$m8 = ($res->fetch_assoc())['m8'];

		$insert_awakes->execute();
		
		$conn->close();
	}else if(_POST['mode'] == 'edit'){
		$monsters_col = array('nameEN','nameJP','ico','rarity','att1','att2','type1','type2','hp','atk','rcv','active','obtain');
		$actives_col = array('description','cooldown');
		$awakes_col = array('m2','m3','m4','m5','m6','m7','m8');
		
		$mID = _POST['mID'];
		foreach ($monsters_col as $col){
			$value = _POST[$col];
			if($value != ''){
				$update_value = $conn->prepare('UPDATE `proticsi_PADR`.`Monsters` SET '. $col . '=? WHERE `mID`=?;');
				$update_value->bind_param('ss', $value, $mID);
				$update_value->execute();
			}
		}
		
		$active = _POST['active'];
		foreach ($actives_col as $col){
			$value = _POST[$col];
			if($value != ''){
				$update_value = $conn->prepare('UPDATE `proticsi_PADR`.`Actives` SET '. $col . '=? WHERE `name`=?;');
				$update_value->bind_param('ss', $value, $active);
				$update_value->execute();
			}
		}

		foreach ($awakes_col as $col){
			$value = _POST[$col];
			if($value != ''){
				$update_value = $conn->prepare('UPDATE `proticsi_PADR`.`MonsterAwakes` SET '. $col . '=? WHERE `name`=?;');
				$update_value->bind_param('ss', $value, $active);
				$update_value->execute();
			}else{
				break;
			}
		}

	}
}else{
	echo 'Enter username and password';
}
?>

<!-- Maybe we need to put php in separate file and point to it in the action attribute? -->
<form method="post" action="">
<fieldset>
    <legend>Login</legend>
	<div class="row">
		<div class="column left">Username:</div>
		<div class="column right"><input type="text" name="username"></div>
	</div>
	<div class="row">
		<div class="column left">Password: </div>
		<div class="column right"><input type="text" name="password"></div>
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
			<option value="0"></option>
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
			<option value="0"></option>
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
		<div class="column right"><select name="m2">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m3">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m4">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m5">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m6">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m7">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select> <select name="m8">
			<option value="0"></option>
			<option value="1">N</option>
			<option value="2">R</option>
			<option value="3">SR</option>
			<option value="4">UR</option>
		</select></div>
	</div>

</fieldset>

  <button type="reset" value="Reset">Reset</button>
  <button type="submit" value="Submit">Submit</button>
</form>


</body>
</html>