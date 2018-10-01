<!DOCTYPE html>
<html>
<style>
ul{
	margin-top: 0;
}
.atk-obtain p{
	width: 50%;
	margin: 0 0;
	float: left;
}
.box{
	width: 80%;
	overflow: auto;
	margin: 0 auto;
	display: grid;
	grid-template-columns: 33% 33% 33%;
}
.float-form div{
	margin: 0px 5px;
	float: left;
}
.grid{
	display: grid;
}
.grid.atts{
	width: 180px;
	grid-template-columns: 30px 30px 30px 30px 30px 30px;
}
.grid.types{
	width: 270px;
	grid-template-columns: 30px 30px 30px 30px 30px 30px 30px 30px 30px;
}
.grid.awakes{
	width: 300px;
	grid-template-columns: 30px 30px 30px 30px 30px 30px 30px 30px 30px 30px;
}

</style>
<body>
<?php
function get_att($att_id){
	$url = "https://pad.protic.site/wp-content/uploads/pad-orbs/";
	return $att_id == '' ? '' : "<img src=\"$url$att_id.png\" class=\"att\" width=30 height=30>";
}

function get_type($type_id){
	$url = "https://pad.protic.site/wp-content/uploads/pad-types/";
	return $type_id == '' || $type_id == '0' ? '' : "<img src=\"$url$type_id.png\" class=\"type\" width=30 height=30>";
}

$awakes = ['', 'rres', 'bres', 'gres', 'lres', 'dres', 'rre', 'bre', 'gre', 'lre', 'dre', 'roe', 'boe', 'goe', 'loe', 'doe', 'hoe', 'prs', 'blrs', 'jrs', 'brs', 'lock', 'hp', 'atk', 'rcv', 'te', 'ah', 'sb', 'brc', 'tpa', '4color', 'fua', 'gok', 'dek', 'drk', 'phk', 'bak', 'aak', 'hek'];
function get_awake($awake_id){
	global $awakes;
	$url = "https://pad.protic.site/wp-content/uploads/padr-awakenings/";
	return $awake_id == '' ? '' : "<img src=\"$url$awakes[$awake_id].png\" class=\"awake\" width=30 height=30>";
}
function get_active_li($name, $description, $cooldown){
	return $name == null ? "" : "<li>$name <b>($cooldown CD)</b><br/>$description</li>";
}

function rarity_select(){
	$out = "<select name=\"rarity\" onchange=\"this.form.submit();\">";
	foreach (["", "3", "4", "5", "6", "7", "8"] as $i){
		$out = $out . "<option value=\"$i\"";
		if($i == $_GET["rarity"]){
			$out = $out . " selected=\"selected\"";
		}
		$out = $out . ">$i</option>";
		
	}
	$out = $out . "</select>";
	return $out;
}
function att_radios($an){
	$out = "";
	foreach (["", "1", "2", "3", "4", "5"] as $i){
		$out = $out . "<div><input type=\"radio\" name=\"att-$an\" value=\"$i\" onchange=\"this.form.submit();\"";
		if($i == $_GET["att-$an"]){
			$out = $out . " checked=\"checked\"";
		}
		$out = $out . "><label for=\"att1-$i\">" . get_att((string)$i) . "</label></div>";
	}
	return $out;
}
function type_radios($tn){
	$out = "";
	foreach (["", "1", "2", "3", "4", "5", "6", "9", "12"] as $i){
		$out = $out . "<div><input type=\"radio\" name=\"type-$tn\" value=\"$i\" onchange=\"this.form.submit();\"";
		if($i == $_GET["type-$tn"]){
			$out = $out . " checked=\"checked\"";
		}
		$out = $out . "><label for=\"type$tn-$i\">" . get_type($i) . "</label></div>";
	}
	return $out;
}
function awake_selects(){
	global $awakes;
	$out = "";
	foreach ($awakes as $a => $wake){
		if($a == ''){
			continue;
		}
		$out = $out . "<div>";
		$out = $out . get_awake($a);
		$out = $out . "<select name=\"awk-$a\" onchange=\"this.form.submit();\">";
		for($i = 0; $i <= 8; $i++){
			$out = $out . "<option value=\"$i\"";
			if($i == $_GET["awk-$a"]){
				$out = $out . " selected=\"selected\"";
			}
			$out = $out . ">$i</option>";
		}
		$out = $out . "</select>";
		$out = $out . "</div>";
	}
	return $out;
}
?>
<form method="get" action="" id="filter-form">
<fieldset class="float-form">
<legend>Filters</legend>
<div>Rarity</div>
<div><?php echo rarity_select();?></div>
<div>
	<div>Attributes: </div>
	<div class="grid atts"><?php echo att_radios('1'); echo att_radios('2');?></div>
</div>
<div>
	<div>Types: </div>
	<div class="grid types"><?php echo type_radios('1'); echo type_radios('2'); echo type_radios('3');?></div>
</div>
<div>
	<div>Awakes: </div>
	<div class="grid awakes"><?php echo awake_selects();?></div>
</div>
<input type="hidden" name="user" value="<?php echo $_GET['user']?>">
<input type="hidden" name="pass" value="<?php echo $_GET['pass']?>">
<button type="reset" value="Reset">Reset</button>
</fieldset>
</form>
<?php $servername = 'box5570.bluehost.com';
$username = $_GET['user'];
$password = $_GET['pass'];
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT `Leaders`.`nameEN`,
    `Leaders`.`nameJP`,
    `Leaders`.`imageAna`,
    `Leaders`.`imageAce`,
    `Leaders`.`atk`,
    `Leaders`.`rarity`,
    `Leaders`.`leadSkill`,
    `Leaders`.`att1`,
    `Leaders`.`att2`,
    `Leaders`.`type1`,
    `Leaders`.`type2`,
    `Leaders`.`type3`,
	a1.`name` an1,
    a2.`name` an2,
    a3.`name` an3,
    a4.`name` an4,
    a5.`name` an5,
	a1.`description` ad1,
    a2.`description` ad2,
    a3.`description` ad3,
    a4.`description` ad4,
    a5.`description` ad5,
	a1.`cooldown` ac1,
    a2.`cooldown` ac2,
    a3.`cooldown` ac3,
    a4.`cooldown` ac4,
    a5.`cooldown` ac5,
	`LeaderAwakes`.`aw1`,
    `LeaderAwakes`.`aw2`,
    `LeaderAwakes`.`aw3`,
    `LeaderAwakes`.`aw4`,
    `LeaderAwakes`.`aw5`,
    `LeaderAwakes`.`aw6`,
    `LeaderAwakes`.`aw7`,
    `LeaderAwakes`.`aw8`,
    `Leaders`.`obtain`,
    `Leaders`.`notes`
FROM `proticsi_PADR`.`Leaders`
INNER JOIN `proticsi_PADR`.`LeaderActives`
on `Leaders`.`lID` = `LeaderActives`.`lID`
INNER JOIN `proticsi_PADR`.`LeaderAwakes`
on `Leaders`.`lID` = `LeaderAwakes`.`lID`
LEFT JOIN `proticsi_PADR`.`Actives` a1
ON `LeaderActives`.`act1` = a1.actID
LEFT JOIN `proticsi_PADR`.`Actives` a2
ON `LeaderActives`.`act2` = a2.actID
LEFT JOIN `proticsi_PADR`.`Actives` a3
ON `LeaderActives`.`act3` = a3.actID
LEFT JOIN `proticsi_PADR`.`Actives` a4
ON `LeaderActives`.`act4` = a4.actID
LEFT JOIN `proticsi_PADR`.`Actives` a5
ON `LeaderActives`.`act5` = a5.actID";
$filters = [];
$params = [""];
if($_GET['rarity'] != ""){
	array_push($filters, "`Leaders`.`rarity`=?");
	$params[] = & $_GET['rarity'];
	//array_push($params, & $_GET['rarity']);
}
for ($i = 1; $i <= 2; $i++){
	if($_GET["att-$i"] != ""){
		array_push($filters, "`Leaders`.`att$i`=?");
		$params[] = & $_GET["att-$i"];
		//array_push($params, & $_GET["att-$i"]);
	}
}
for ($i = 1; $i <= 3; $i++){
	if($_GET["type-$i"] != ""){
		array_push($filters, "`Leaders`.`type$i`=?");
		$params[] = & $_GET["type-$i"];
		//array_push($params, & $_GET["type-$i"]);
	}
}
if(count($filters) > 0){
	$sql = $sql . " WHERE ";
	foreach ($filters as $f => $ilter){
		$sql = $sql . $ilter;
		if($f < count($filters) - 1){
			$sql = $sql . " AND ";
		}
	}
}
$param_type = str_repeat("s", count($filters));
$params[0] = & $param_type;
$sql = $sql . " ORDER BY `Leaders`.`obtain`, `Leaders`.`rarity` ASC;";
echo print_r($params);

$select = $conn->prepare($sql);
call_user_func_array(array($select, 'bind_param'), $params);
$select->bind_result($nameEN, $nameJP, $imageAna, $imageAce, $atk, $rarity, $leadSkill, $att1, $att2, $type1, $type2, $type3, $an1, $an2, $an3, $an4, $an5, $ad1, $ad2, $ad3, $ad4, $ad5, $ac1, $ac2, $ac3, $ac4, $ac5, $aw1, $aw2, $aw3, $aw4, $aw5, $aw6, $aw7, $aw8, $obtain, $notes);
$id = $_GET['id'];
if(!$select->execute()){
	die('Select soul armor failed: ' . $conn->error . '.</br>');
}
/*$str = [
	"Starters" => '',
	"Radar Point" => '',
	"Rare" => '',
    "NPC" => '',
];*/
$out = "<div class=\"box\">";
while($select->fetch()){
	$out = $out . "<div class=\"padr-armor\" data-att=\"$att1 $att2\" data-type=\"$type1 $type2 $type3\" data-rarity=\"$rarity\" data-awakes=\"$aw1 $aw2 $aw3 $aw4 $aw5 $aw6 $aw7 $aw8\"><div class=\"rarity\">$rarity Star</div><div class=\"img\"><img src=\"$imageAna\"/ width=\"100\" height=\"100\"><img src=\"$imageAce\" width=\"100\" height=\"100\"/></div><div class=\"name\">" . get_att($att1) . get_att($att2) . "$nameEN<br/>$nameJP</div><div class=\"type\">" . get_type($type1) . get_type($type2) . get_type($type3) . "</div><div class=\"atk-obtain\"><p>ATK $atk</p><p>$obtain</p></div><div class=\"awakes\">" . get_awake($aw1) . get_awake($aw2) . get_awake($aw3) . get_awake($aw4) . get_awake($aw5) . get_awake($aw6) . get_awake($aw7) . get_awake($aw8) . "</div><div class=\"actives\">Actives: <ul>" . get_active_li($an1, $ad1, $ac1) . get_active_li($an2, $ad2, $ac2) . get_active_li($an3, $ad3, $ac3) . get_active_li($an4, $ad4, $ac4) . get_active_li($an5, $ad5, $ac5) . "</ul></div><div class=\"leadskill\">Leader Skill: <p>$leadSkill</p></div>";
	$out = strlen($notes) == 0 ? $out : $out . "<div class=\"notes\"><i>$notes</i></div>";
	$out = $out . "</div>";
}
$out = $out . "</div>";
echo $out;
?>

</body>
</html>