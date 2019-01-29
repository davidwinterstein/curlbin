function filter() {
	var inputName, inputComment, filterName, filterComment, table, tr, results, newresults, tdName, tdComment, i;
	inputName = document.getElementById("name");
	inputComment = document.getElementById("comment");
	filterName = inputName.value.toUpperCase();
	filterComment = inputComment.value.toUpperCase();
	table = document.getElementById("list");
	tr = table.getElementsByTagName("tr");
	results = document.getElementById("results");
	newresults = 0;

	for (i = 0; i < tr.length; i++) {
		tdName = tr[i].getElementsByTagName("td")[0];
		tdComment = tr[i].getElementsByTagName("td")[1];

		if (tdName && tdComment) {
			if ((tdName.innerHTML.toUpperCase().indexOf(filterName) > -1) && (tdComment.innerHTML.toUpperCase().indexOf(filterComment) > -1)) {
				tr[i].style.display = "";
				newresults++;
			} else {
				tr[i].style.display = "none";
			}
		}
	}

	results.innerHTML = newresults;
}
