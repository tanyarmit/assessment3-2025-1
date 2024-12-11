// Dropdown menu
function thisMenu() {
	var menu = document.getElementById("menu");
	var optionNumber = menu.options.selectedIndex;
	var url = menu.options[optionNumber].value;
	location.href = url;
}