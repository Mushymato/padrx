<!DOCTYPE html>
<html>
<head>
<?php include 'padrx_common.php';?>
	<script type="text/javascript">
		window.onload = function(){
			for (i = 1; i <= 38; i++) { 
				document.getElementById("awk" + i).addEventListener("change", displaySelectedAwakes);
			}
			document.getElementById("filter-form").addEventListener("change", filterArmors);
			document.getElementById("filter-form").addEventListener("reset", resetFilters);
			document.getElementById("filter-form").addEventListener("submit", function(){
				resetFilters();
				event.preventDefault();
			});
			document.getElementById("result-count").innerHTML = document.querySelectorAll(".padr-armor").length + " results.";
		}
	</script>
</head>
<body>
<?php
function display_armors($username, $password){
	$conn = create_connection($username, $password);
	$result = select_armors($conn);
	$conn->close();

	$edit = true;
	$out = "<div class=\"padr-armor-display\">";
	foreach($result as $r){
		$out = $out . "<div class=\"padr-armor\" data-rarity=\"{$r['rarity']}\" data-obtain=\"{$r['obtain']}\" data-names=\"{$r['nameEN']} {$r['nameJP']}\" data-att=\"{$r['attribute1']} {$r['attribute2']}\" data-type=\"{$r['type1']} {$r['type2']} {$r['type3']}\" data-awakes=\"{$r['awake1']} {$r['awake2']} {$r['awake3']} {$r['awake4']} {$r['awake5']} {$r['awake6']} {$r['awake7']} {$r['awake8']}\">";
		$out = $out . "<div class=\"rarity half\"><p>{$r['rarity']} Star</p>";
		$out = $edit ? $out . "<p><a href=\"armor_edit.php?user=$username&pass=$password&id={$r['aID']}  target=\"_blank\">Edit</a></p>" : $out;
		$out = $out . "</div>";
		$out = $out . "<div class=\"image\">" . get_armor_image($r['imageAna']) . get_armor_image($r['imageAce']) . "</div>";
		$out = $out . "<div class=\"name\">" . get_att($r['attribute1']) . get_att($r['attribute2']) . "{$r['nameEN']}<br/>{$r['nameJP']}</div>";
		$out = $out . "<div class=\"type\">" . get_type($r['type1']) . get_type($r['type2']) . get_type($r['type3']) . "</div>";
		$out = $out . "<div class=\"atk-obtain half\"><p>ATK {$r['atk']}</p><p>{$r['obtain']}</p></div>";
		$out = $out . "<div class=\"awakes\">";
		for($i = 1; $i <= 8; $i++){
			$out = $out . get_awake($r["awake$i"]);
		}
		$out = $out . "</div>";
		$out = $out . "<div class=\"actives\">Actives: <ul>";
		for($i = 1; $i <= 8; $i++){
			$out = isset($r["an$i"]) ? $out . "<li>{$r["an$i"]} <b>({$r["ac$i"]} CD)</b><br/>{$r["ad$i"]}</li>" : $out;
		}
		$out = $out . "</ul></div>";
		$out = $r['leadSkill'] == "" ? $out : $out . "<div class=\"leadskill\">Leader Skill: <p>{$r['leadSkill']}</p></div>";
		$out = $r['notes'] == "" ? $out : $out . "<div class=\"notes\"><i>{$r['notes']}</i></div>";
		$out = $out . "</div>";
	}
	$out = $out . "</div>";
	return $out;
}
$res = display_armors($_GET['user'], $_GET['pass']);
?>
<form id="filter-form" method="POST">
<fieldset class="float">
<legend>Filters</legend>
<div>
	<div>Rarity: <?php echo form_select('select-rarity', array_merge([''], range(3, 8)));?></div>
	<div>Obtain: <?php echo form_select('select-obtain', ['', 'Starters', 'Radar Point', 'Rare', 'NPC']);?></div>
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
<div>
	<div>Selected:</div>
	<div class="grid" id="selected-awakes"></div>
	<div>Name:</div>
	<div><input type="text" id="name-input"></div>
</div>
<div>
	<div id="result-count"></div>
	<a href="armor_edit.php?<?php echo "user={$_GET['user']}&pass={$_GET['pass']}";?>">Add/Edit</a>
	<button type="reset" value="Reset">Reset</button>
</div>
</fieldset>
</form>
<?php
echo $res;
?>

</body>
</html>