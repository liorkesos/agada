function WritersOptions(type)
{
	if (type == "all") {
		document.getElementById("edit-filter-kids").checked = document.getElementById("edit-filter-all").checked;
		document.getElementById("edit-filter-adults").checked = document.getElementById("edit-filter-all").checked;

		if (document.getElementById("edit-filter-all").checked) {
			document.getElementById("edit-writer-kids").disabled = "";
			document.getElementById("edit-writer").disabled = "";
		}
		else {
			document.getElementById("edit-writer-kids").disabled = "disabled";
			document.getElementById("edit-writer").disabled = "disabled";
		}
	}
}
//--------------------------------------
function resetMidrashLevels()
{
	var field_1 = document.getElementById('midrash_source_1_select');
	var field_2 = document.getElementById('midrash_source_2_select');
	if (field_1.length > 0 && field_2.length > 0)
	{
		field_1.style.display = "none";
		field_2.style.display = "none";
	}
	
}