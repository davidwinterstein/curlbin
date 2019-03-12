function clipboard(copyid,sudo) {
	var id = 'copy_' + copyid;
	if (sudo === false) {
		var mod = 'nosu';
	} else {
		var mod = 'sudo';
	}
	var copy = document.getElementById(id + '_' + mod);
	var success = document.getElementById("success");

	copy.select();
	document.execCommand('copy');
	success.innerHTML = '<p style="margin: 0; padding: 0 0 5px;">copied:</p><span style="font-family: Courier New; font-weight: bold;">' + copy.value + '</span>';
	success.classList.add('show');

	setTimeout(function () {
		success.classList.remove('show');
	}, 3000);
}
