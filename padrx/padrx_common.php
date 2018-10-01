<meta charset="utf-8">
<link href="padrx_style.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="padrx_scripts.js"></script>
<?php
$msg = '';
function create_connection($username, $password){
	$conn = new mysqli("pad.protic.site", $username, $password);
	if ($conn->connect_error) {
		trigger_error('Connection failed: ' . $conn->connect_error);
		header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
		die('you cannot');
	}else{
		return $conn;
	}
}
function get_att($att_id){
	$url = "https://pad.protic.site/wp-content/uploads/pad-orbs/";
	return $att_id == '' ? '' : "<img src=\"$url$att_id.png\" class=\"att\" alt=\"$att_id\">";
}
function get_type($type_id){
	$url = "https://pad.protic.site/wp-content/uploads/pad-types/";
	return $type_id == '' || $type_id == '0' ? '' : "<img src=\"$url$type_id.png\" class=\"type\" alt=\"$type_id\">";
}
$awakes = ['', 'rres', 'bres', 'gres', 'lres', 'dres', 'rre', 'bre', 'gre', 'lre', 'dre', 'roe', 'boe', 'goe', 'loe', 'doe', 'hoe', 'prs', 'blrs', 'jrs', 'brs', 'lock', 'hp', 'atk', 'rcv', 'te', 'ah', 'sb', 'brc', 'tpa', '4color', 'fua', 'gok', 'dek', 'drk', 'phk', 'bak', 'aak', 'hek'];
function get_awake($awake_id){
	global $awakes;
	$url = "https://pad.protic.site/wp-content/uploads/padr-awakenings/";
	return $awake_id == '' ? '' : "<img src=\"$url$awakes[$awake_id].png\" class=\"awake\" alt=\"$awakes[$awake_id]\">";
}
function get_armor_image($img_name){
	$url = "idk/";
	return $img_name == '' ? '' : "<img title=\"$img_name\" alt=\"$img_name\" src=\"$url$img_name\"/>";
}

function form_select($name, $values, $checked = ''){
	$out = "<select name=\"$name\" id=\"$name\" required>";
	foreach ($values as $i){
		$out = $out . "<option value=\"$i\"";
		if($i == $checked){ $out = $out . " selected=\"selected\"";
		}
		$out = $out . ">$i</option>";
	}
	$out = $out . "</select>";
	return $out;
}

function form_textbox($name, $value = '', $required=true, $numerical = false){
	$out = "<input type=\"text\" name=\"$name\" id=\"$name\"";
	if($value != ''){$out = $out . " value=\"$value\"";}
	if($required){$out = $out . " required";}
	if($numerical){$out = $out . " pattern=\"[0-9]+\" title=\"Number\"";}
	$out = $out . "\">";
	return $out;
}

function att_radios($att_num, $checked = '', $required = false){
	$out = '';
	$atts = range(1, 5);
	if($required){
		$out = $out . "<div><input type=\"radio\" name=\"attribute$att_num\" required disabled></div>";
	}else{
		array_unshift($atts, '');
	}
	foreach ($atts as $i){
		$out = $out . "<div><input type=\"radio\" name=\"attribute$att_num\" value=\"$i\"";
		if($i == $checked){$out = $out . " checked";}
		$out = $out . "><label for=\"att$att_num-$i\">" . get_att((string)$i) . "</label></div>";
	}
	return $out;
}
function type_radios($type_num, $checked = '', $required = false){
	$out = '';
	$types = ['1', '2', '3', '4', '5', '6', '9', '12'];
	if($required){
		$out = $out . "<div><input type=\"radio\" name=\"type$type_num\" required disabled></div>";
	}else{
		array_unshift($types, '');
	}
	foreach ($types as $i){
		$out = $out . "<div><input type=\"radio\" name=\"type$type_num\" value=\"$i\"";
		if($required){$out = $out . " required";}
		if($i == $checked){$out = $out . " checked";}
		$out = $out . "><label for=\"type$type_num-$i\">" . get_type($i) . "</label></div>";
	}
	return $out;
}
function awake_selects($awake_array = []){
	$awake_counts = array();
	foreach($awake_array as $awk){
		if(array_key_exists($awk, $awake_counts)){ $awake_counts[$awk]++;
		}else{ $awake_counts[$awk] = 1;
		}
	}
	global $awakes;
	$out = "";
	foreach ($awakes as $awk => $name){
		if($awk == ''){ continue;
		}
		$out = $out . "<div>";
		$out = $out . get_awake($awk);
		if(array_key_exists($awk, $awake_counts)){ $out = $out . form_select("awk$awk", range(0, 8), $awake_counts[$awk]);
		}else{ $out = $out . form_select("awk$awk", range(0, 8));
		}
		$out = $out . "</div>";
	}
	return $out;
}
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}
function select_armors($conn, $key = '', $val = ''){
	$sql = "SELECT `Armors`.`aID`, `Armors`.`nameEN`, `Armors`.`nameJP`, `Armors`.`imageAna`, `Armors`.`imageAce`, `Armors`.`atk`, `Armors`.`rarity`, `Armors`.`leadSkill`, `Armors`.`attribute1`, `Armors`.`attribute2`, `Armors`.`type1`, `Armors`.`type2`, `Armors`.`type3`, `Armors`.`active1`, `Armors`.`active2`, `Armors`.`active3`, `Armors`.`active4`, `Armors`.`active5`, a1.`name` an1, a2.`name` an2, a3.`name` an3, a4.`name` an4, a5.`name` an5, a1.`description` ad1, a2.`description` ad2, a3.`description` ad3, a4.`description` ad4, a5.`description` ad5, a1.`cooldown` ac1, a2.`cooldown` ac2, a3.`cooldown` ac3, a4.`cooldown` ac4, a5.`cooldown` ac5, `Armors`.`awake1`, `Armors`.`awake2`, `Armors`.`awake3`, `Armors`.`awake4`, `Armors`.`awake5`, `Armors`.`awake6`, `Armors`.`awake7`, `Armors`.`awake8`, `Armors`.`obtain`, `Armors`.`notes`
	FROM `proticsi_PADR`.`Armors`
	LEFT JOIN `proticsi_PADR`.`Actives` a1
	ON `active1` = a1.`actID`
	LEFT JOIN `proticsi_PADR`.`Actives` a2
	ON `active2` = a2.`actID`
	LEFT JOIN `proticsi_PADR`.`Actives` a3
	ON `active3` = a3.`actID`
	LEFT JOIN `proticsi_PADR`.`Actives` a4
	ON `active4` = a4.`actID`
	LEFT JOIN `proticsi_PADR`.`Actives` a5
	ON `active5` = a5.`actID`";
	if($key != ''){
		$sql = $sql . " WHERE `Armors`.`$key` = ?;";
	}else{
		$sql = $sql . " ORDER BY `Armors`.`obtain`, `Armors`.`rarity`, `Armors`.`attribute1` ASC;";
	}
	$stmt = $conn->prepare($sql);
	if(!$stmt){
		trigger_error('Select soul armor failed: ' . $conn->error . '.</br>');
	}
	if($key != ''){
		$stmt->bind_param("s", $val);
	}
	if(!$stmt->execute()){
		trigger_error('Select soul armor failed: ' . $conn->error . '.</br>');
	}
	$stmt->store_result();
	if($stmt->num_rows == 0){
		$stmt->free_result();
		$stmt->close();
		return array();
	}
	$fields = array();
	$row = array();
	$meta = $stmt->result_metadata(); 
	while($f = $meta->fetch_field()){
		$fields[] = & $row[$f->name];
	}
	$res = array();
	call_user_func_array(array($stmt, 'bind_result'), $fields);
	while ($stmt->fetch()) { 
		foreach($row as $key => $val) 
		{  $c[$key] = $val; 
		} 
		$res[] = $c; 
	}
	$stmt->free_result();
	$stmt->close();
	return $res;
}
function select_one_active($conn, $key, $value){
	$sql = "SELECT `Actives`.`actID`, `Actives`.`name`, `Actives`.`description`, `Actives`.`cooldown` FROM `proticsi_PADR`.`Actives` WHERE `$key` = ?;";
	$stmt = $conn->prepare($sql);
	if(!$stmt){
		trigger_error($conn->error . "[prepare($sql)]");
		return $stmt->close() && false;
	}
	$stmt->bind_param('s', $value);
	$stmt->bind_result($actID, $name, $description, $cooldown);
	if(!$stmt->execute()){
		trigger_error($conn->error . "[execute($sql)]");
		return $stmt->close() && false;
	}
	if($stmt->fetch()){
		$stmt->close();
		return array('actID' => $actID, 'name' => $name, 'description' => $description, 'cooldown' => $cooldown);
	}else{
		$stmt->close();
		return false;
	}
}
function add_active($conn, $active){
	$result = false;
	if(!array_key_exists('name', $active) || !array_key_exists('description', $active) || !array_key_exists('cooldown', $active)){
		$msg = $msg . "add_active: Not enough parameters.";
		return false;
	}
	if(array_key_exists('actID', $active)){
		$result = select_one_active($conn, 'actID', $active['actID']);
	}else{
		$result = select_one_active($conn, 'name', $active['name']);
	}
	if($result){
		if(sizeof(array_diff($active, $result)) == 0){
			return false;
		}
		$sql = "UPDATE `proticsi_PADR`.`Actives` SET `name` = ?, `description` = ?, `cooldown` = ? WHERE `actID` = ?;";
		$stmt = $conn->prepare($sql);
		if(!$stmt){
			trigger_error($conn->error . "[prepare($sql)]");
			return $stmt->close() && false;
		}
		$stmt->bind_param('ssss', $active['name'], $active['description'], $active['cooldown'], $result['actID']);
		if(!$stmt->execute()){
			trigger_error($conn->error . "[execute($sql)]");
			return $stmt->close() && false;
		}else{
			$stmt->close();
			$msg = $msg . "Changed active {$active['name']}.";
			return $result['actID'];
		}
	}else{
		$sql = "INSERT INTO `proticsi_PADR`.`Actives` (`name`, `description`, `cooldown`) VALUES (?, ?, ?);";
		$stmt = $conn->prepare($sql);
		if(!$stmt){
			trigger_error($conn->error . "[prepare($sql)]");
			return $stmt->close() && false;
		}
		$stmt->bind_param('sss', $active['name'], $active['description'], $active['cooldown']);
		if(!$stmt->execute()){
			trigger_error($conn->error . "[execute($sql)]");
			return $stmt->close() && false;
		}else{
			$actID = $stmt->insert_id;
			$stmt->close();
			$msg = $msg . "Added active {$active['name']}.";
			return $actID;
		}
	}
}
?>