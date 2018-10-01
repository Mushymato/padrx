<!DOCTYPE html>
<html>
<header>
<?php include 'padrx_common.php';?>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("edit-form").addEventListener("reset", function(){
				setTimeout(displaySelectedAwakes, 100);
			});
			for (i = 1; i <= 38; i++) { 
				document.getElementById("awk" + i).addEventListener("change", displaySelectedAwakes);
			}
			displaySelectedAwakes();
		}
	</script>
</header>
<body>
<?php
$fieldnames = ['nameEN', 'nameJP', 'imageAna', 'imageAce', 'atk', 'rarity', 'leadSkill', 'attribute1', 'attribute2', 'type1', 'type2', 'type3', 'active1', 'active2', 'active3', 'active4', 'active5', 'awake1', 'awake2', 'awake3', 'awake4', 'awake5', 'awake6', 'awake7', 'awake8', 'obtain', 'notes'];
function process_inputs($conn){
	Global $fieldnames;
	$fields = array([]);
	$active_prefix = array('aid' => 'actID', 'an' => 'name', 'ad' => 'description', 'ac' => 'cooldown');
	$actIds = array();
	for($i = 1; $i <= 5; $i++){
		$active_input = array();
		foreach($active_prefix as $ap => $fn){
			if(array_key_exists($ap . $i, $_POST) && $_POST[$ap . $i] != ''){
				$active_input[$fn] = $_POST[$ap . $i];
			}
		}
		$res = add_active($conn, $active_input);
		if($res){
			$actIds["active$i"] = $res;
		}
	}
	foreach($fieldnames as $fn){
		if(array_key_exists($fn, $_POST) && $_POST[$fn] != ''){
			$fields[0][] = $fn;
			$fields[] = $_POST[$fn];
		}else if(array_key_exists($fn, $actIds)){
			$fields[0][] = $fn;
			$fields[] = $actIds[$fn];
		}
	}
	return $fields;
}
function insert_armor($conn){
	$sql = "INSERT INTO `proticsi_PADR`.`Armors` (";
	$fields = process_inputs($conn);
	foreach($fields[0] as $fn){
		$sql = $sql . $fn . ",";
	}
	$sql = substr($sql, 0, strlen($sql) - 1) . ") VALUES (" . str_repeat("?, ", sizeof($fields) - 2) . "?);";
	$fields[0] = str_repeat('s', sizeof($fields) - 1);
	$stmt = $conn->prepare($sql);
	if(!$stmt){
		trigger_error($conn->error . "[prepare($sql)]");
		return $stmt->close() && false;
	}
	print_r($fields);
	echo "</br>" . $sql;
	call_user_func_array(array($stmt, 'bind_param'), refValues($fields));
	if(!$stmt->execute()){
		trigger_error($conn->error . "[execute($sql)]");
		return $stmt->close() && false;
	}
	return $stmt->close();
}
function update_armor($conn, $aID){
	$sql = "UPDATE `proticsi_PADR`.`Armors` SET ";
	$fields = process_inputs($conn);
	foreach($fields[0] as $fn){
		$sql = $sql . $fn . " = ?," ;
	}
	$sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `aID` = ?;";
	$fields[0] = str_repeat('s', sizeof($fields));
	$fields[] = & $aID;
	$stmt = $conn->prepare($sql);
	if(!$stmt){
		trigger_error($conn->error . "[prepare($sql)]");
		return $stmt->close() && false;
	}
	call_user_func_array(array($stmt, 'bind_param'), refValues($fields));
	print_r($fields);
	echo "</br>" . $sql;
	if(!$stmt->execute()){
		trigger_error($conn->error . "[execute($sql)]");
		return $stmt->close() && false;
	}
	return $stmt->close();
}
function selected($key){
	Global $sel;
	return isset($sel) && array_key_exists($key, $sel) ? $sel[$key] : "";
}
function edit_armor($conn){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$redirect = "armor_edit.php?user=" . $_GET['user'] . "&pass=" . $_GET['pass'];
		Global $msg;
		$result = null;
		$sucess = false;
		if(array_key_exists('aID', $_POST) && $_POST['aID'] != ''){
			$result = select_armors($conn, 'aID', $_POST['aID']);
			$msg = $msg . "<p>Check with aID = {$_POST['aID']}</p>";
		}else if($_POST['nameJP'] != ''){
			$result = select_armors($conn, 'nameJP', $_POST['nameJP']);
			$msg = $msg . "<p>Check with nameJP = {$_POST['nameJP']}</p>";
		}
		if(sizeof($result) == 0){
			$msg = $msg . "<p>No entry found, insert.</p>";
			$sucess = insert_armor($conn);
		}else{
			$msg = $msg . "<p>Previous entry found, update.</p>";
			$sucess = update_armor($conn, $result[0]['aID']);
		}
		if($sucess){
			$msg = $msg . "<p>Change success.</p>";
		}else{
			$msg = $msg . "<p>Change failed.</p>";
		}
		die("<div>$msg</div><div><a href=\"armor_edit.php?user=" . $_GET['user'] . "&pass=" . $_GET['pass'] . "\">back to edit</a></div><div><a href=\"armor.php?user=" . $_GET['user'] . "&pass=" . $_GET['pass'] . "\">back to armors</a></div>");
	}else{
		$result = null;
		if (isset($_GET['id'])){
			$result = select_armors($conn, 'aID', $_GET['id']);
		}else if(isset($_GET['nameJP'])){
			$result = select_armors($conn, 'nameJP', $_GET['nameJP']);
		}
		return sizeof($result) > 0 ? $result[0] : null;
	}
}
$conn = create_connection($_GET['user'], $_GET['pass']);
$sel = edit_armor($conn);
$conn->close();
?>
<form id="edit-form" method="post" action="armor_edit.php<?php echo "?user=" . $_GET['user'] . "&pass=" . $_GET['pass'];?>">
<fieldset class="float">
    <legend>
		<?php 
		if(isset($sel['aID'])){
			echo "Edit Soul Armor - {$sel['aID']}"; 
			echo "<input type=\"hidden\" name=\"aID\" value=\"{$sel['aID']}\">";
		}else{
			echo "Add New Soul Armor";
		}?>
	</legend>
	<div class="grid two-col">
		<div>EN Name: </div>
		<div><?php echo form_textbox('nameEN', selected('nameEN'));?></div>
		<div>JP Name: </div>
		<div><?php echo form_textbox('nameJP', selected('nameJP'));?></div>
		<div>Image(Ana): </div>
		<div><?php echo form_textbox('imageAna', selected('imageAna'), false);?></div>
		<div>Image(Ace): </div>
		<div><?php echo form_textbox('imageAce', selected('imageAce'), false);?></div>
		<div>Rarity: </div>
		<div><?php echo form_select('rarity', array_merge([''], range(3, 8)), selected('rarity'));?></div>
		<div>ATK: </div>
		<div><?php echo form_textbox('atk', selected('atk'), true, 'pattern="[0-9]+" title="Number"');?></div>
		<div>Leader Skill:</div>
		<div><textarea name="leadSkill" id="leadSkill" required pattern=\"[A-Za-z0-9]+\"><?php echo selected('leadSkill');?></textarea></div>
		<div>Obtain from: </div>
		<div><?php echo form_select('obtain', ['', 'Radar Point', 'Rare', 'NPC', 'Starters'], selected('obtain'));?></div>
		<div>Notes: </div>
		<div><textarea name="notes" id="notes"><?php echo selected('notes');?></textarea></div>
	</div>
	
	<div>
	</div>
	<div>
		<div>Attributes: </div>
		<div>
			<div class="grid atts"><?php echo att_radios('1', selected('attribute1'), true); echo att_radios('2', selected('attribute2'));?></div>
		</div>
	</div>
	<div>
		<div>Types: </div>
		<div>
			<div class="grid types"><?php echo type_radios('1', selected('type1'), true); echo type_radios('2', selected('type2')); echo type_radios('3', selected('type3'));?></div>
		</div>
	</div>
	<div>
	</div>
	<div>
		<div>Awakenings: </div>
		<div>
			<div class="grid" id="selected-awakes"></div>
			<div class="grid awakes"><?php echo awake_selects([selected('awake1'), selected('awake2'), selected('awake3'), selected('awake4'), selected('awake5'), selected('awake6'), selected('awake7'), selected('awake8')]);?></div>
			<?php
				for($i = 1; $i <= 8; $i++){
					echo "<input type=\"hidden\" name=\"awake$i\" id=\"awake$i\" value=\"" . selected("awake$i") . "\">";
				}
			?>
		</div>
	</div>
	<div>
		<div>Active: </div>
		<div>
		<?php
			echo "<ul>";
			for($i = 1; $i <= 5; $i++){
				echo "<li><div class=\"grid active\">" . form_textbox("an$i", selected("an$i"), false) . form_textbox("ac$i", selected("ac$i"), false, true) . "<textarea name=\"ad$i\" id=\"ad$i\" pattern=\"[A-Za-z0-9]+\">" . selected("ad$i") . "</textarea></div>";
				if(selected("active$i") != ""){
					echo "<input type=\"hidden\" name=\"aid$i\" id=\"aid$i\" value=\"" . selected("active$i") . "\">";
				}
				echo "</li>";
			}
			echo "</ul>";
		?>
		</div>
	</div>
	<div>
		<div><a href="armor.php?<?php echo "user={$_GET['user']}&pass={$_GET['pass']}";?>">Return</a></div>
		<div><button type="reset" value="Reset">Reset</button><button type="submit" value="Submit">Submit</button></div>
	</div>
	</fieldset>
</form>

</body>
</html>