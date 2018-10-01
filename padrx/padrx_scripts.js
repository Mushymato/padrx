function getSelectedAwakes(){
	filter = {};
	for(i = 1; i < 39; i++){
		var c = parseInt(document.getElementById("awk" + i).value);
		if (!isNaN(c) && c > 0){
			filter[i.toString()] = c;
		}
	}
	return filter;
}
function checkAwakesCount(awakeArr, awakeFilter){
	counts = {};
	for (var i = 0; i < awakeArr.length; i++){
		if(counts.hasOwnProperty(awakeArr[i])){
			counts[awakeArr[i]]++;
		}else{
			counts[awakeArr[i]] = 1;
		}
	}
	for (var awk in awakeFilter){
		if(!counts.hasOwnProperty(awk)){
			return false;
		}
		if(awakeFilter[awk] > counts[awk]){
			return false;
		}
	}
	return true;
}
function filterArmors(){
	var armors = document.querySelectorAll(".padr-armor");

	var m = document.querySelector('input[name="attribute1"]:checked').value;
	var s = document.querySelector('input[name="attribute2"]:checked').value;
	
	var t1 = document.querySelector('input[name="type1"]:checked').value;
	var t2 = document.querySelector('input[name="type2"]:checked').value;
	t2 = t1 === t2 ? "" : t2;
	var t3 = document.querySelector('input[name="type3"]:checked').value;
	t3 = t1 === t3 ? "" : t3;
	t3 = t2 === t3 ? "" : t3;

	var e = document.getElementById("select-rarity");
	var rare = parseInt(e.options[e.selectedIndex].value);
	e = document.getElementById("select-obtain");
	var obt = e.options[e.selectedIndex].value;

	var sa = getSelectedAwakes();
	
	var ni = document.getElementById("name-input").value;
	
	var resultCount = 0;
	for (var i = 0; i < armors.length; i++) {
		var atts = armors[i].getAttribute("data-att").split(" ");
		var types = armors[i].getAttribute("data-type").split(" ");
		var awakes = armors[i].getAttribute("data-awakes").split(" ");
		if(
			(atts[0].startsWith(m) && atts[1].startsWith(s)) &&
			(types[0].startsWith(t1) && types[1].startsWith(t2) && types[2].startsWith(t3)) && 
			(isNaN(rare) || parseInt(armors[i].getAttribute("data-rarity")) == rare) &&
			(obt == "" || armors[i].getAttribute("data-obtain") == obt) &&
			armors[i].getAttribute("data-names").toLowerCase().includes(ni) &&
			checkAwakesCount(awakes, sa)
		){
			armors[i].style.display = "block";
			resultCount++;
		}else{
			armors[i].style.display = "none";
		}
	}
	document.getElementById("result-count").innerHTML = resultCount + " results.";
}
function getSelectedAwakes(){
	filter = {};
	for(i = 1; i < 39; i++){
		var c = parseInt(document.getElementById("awk" + i).value);
		if (!isNaN(c) && c > 0){
			filter[i.toString()] = c;
		}
	}
	return filter;
}
function displaySelectedAwakes(){
	var selectedAwakes = getSelectedAwakes();
	var selectedAwakesBox = document.getElementById("selected-awakes");
	while (selectedAwakesBox.firstChild) {
		selectedAwakesBox.removeChild(selectedAwakesBox.firstChild);
	}
	var awakeNames = ['', 'rres', 'bres', 'gres', 'lres', 'dres', 'rre', 'bre', 'gre', 'lre', 'dre', 'roe', 'boe', 'goe', 'loe', 'doe', 'hoe', 'prs', 'blrs', 'jrs', 'brs', 'lock', 'hp', 'atk', 'rcv', 'te', 'ah', 'sb', 'brc', 'tpa', '4color', 'fua', 'gok', 'dek', 'drk', 'phk', 'bak', 'aak', 'hek'];
	var url = "https://pad.protic.site/wp-content/uploads/padr-awakenings/";
	var cnt = 1;
	var node = null;
	for (var awk in selectedAwakes){
		var imgSrc = url + awakeNames[awk] + ".png";
		for(i = 0; i < selectedAwakes[awk]; i++){
			node = document.createElement("img");
			node.setAttribute("src", imgSrc);
			node.setAttribute("class", "awake");
			node.setAttribute("alt", awakeNames[awk]);			
			selectedAwakesBox.appendChild(node);

			node = document.getElementById("awake" + cnt);
			//console.log(node);
			if(node != null){
				node.setAttribute("value", awk);
			}
			cnt++;
		}
	}
}
function clearSelectedAwakes(){
	var selectedAwakesBox = document.getElementById("selected-awakes");
	if(selectedAwakesBox != null){
		while (selectedAwakesBox.firstChild) {
			selectedAwakesBox.removeChild(selectedAwakesBox.firstChild);
		}
	}
}
function resetFilters(){
	var armors = document.querySelectorAll(".padr-armor");
	document.getElementById("result-count").innerHTML = armors.length + " results.";
	for (var i = 0; i < armors.length; i++) {
		armors[i].style.display = "block";
	}
	clearSelectedAwakes();
}