<?php

if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
	$PROTO = 'https';
} else {
	$PROTO = 'http';
}
$DOMAIN = $_SERVER['HTTP_HOST'];
$URI = $_SERVER['REQUEST_URI'];

$RESULTS = 0;
$TABLE = '
<tr>
	<th><input type="text" id="name" onkeyup="filter()" placeholder="filter"></th>
	<th><input type="text" id="comment" onkeyup="filter()" placeholder="filter"></th>
	<th></th>
	<th style="font-size: 0.75em;">su</th>
</tr>
';

$FILES = preg_grep('/^(index\.[^\.]+|[^\.]+\.(png|jpg|ico|svg)|inc)/', glob('scripts/*'), PREG_GREP_INVERT);
foreach ($FILES as $FILE) {
	$FILENAME = preg_replace('/^scripts\//','',$FILE);
	$DESCRIPTIONLINE = preg_grep('/^# DESCRIPTION: /',file($FILE));
	$DESCRIPTION = preg_replace('/^# DESCRIPTION: /','',$DESCRIPTIONLINE[2]);
	$RESULTS++;
	$TABLE .= '
<tr>
	<td style="text-align: right;">
		<a href="' . $PROTO . '://' . $DOMAIN . $URI . $FILENAME . '">' . $FILENAME . '</a>
	</td>
	<td style="text-align: left;">
		' . $DESCRIPTION . '
	</td>
	<td>
		<button class="clip" onclick="clipboard(\'' . $RESULTS . '\',false)">
			<img src="inc/img/sh.png">
			<div class="copy"><textarea id="copy_' . $RESULTS . '_nosu">curl -s ' . $PROTO . '://' . $DOMAIN . $URI . $FILENAME . ' |bash</textarea></div>
			<span class="tooltip">curl -s ' . $PROTO . '://' . $DOMAIN . $URI . $FILENAME . ' |bash</span>
		</button>
	</td>
	<td>
		<button class="clip" onclick="clipboard(\'' . $RESULTS . '\',true)">
			<img src="inc/img/rsh.png">
			<div class="copy"><textarea id="copy_' . $RESULTS . '_sudo">curl -s ' . $PROTO . '://' . $DOMAIN . $URI . $FILENAME . ' |sudo bash</textarea></div>
			<span class="tooltip">curl -s ' . $PROTO . '://' . $DOMAIN . $URI . $FILENAME . ' |sudo bash</span>
		</button>
	</td>
</tr>';
}

$HTML = '
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/png" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" />
		<link rel="stylesheet" href="inc/css/style.css" />
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1.0">
		<meta charset="UTF-8" />
		<meta name="keywords" content="scripts,web,bin,cli,shell,sh,bash" />
		<meta name="description" content="cli/shell scripts provided for execution via curl" />
		<meta name="author" content="David Winterstein" />
		<title>curlbin</title>
		<script src="inc/js/filter.js"></script>
		<script src="inc/js/clipboard.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<main>
				<table id="list">
					' . $TABLE . '
				</table>
				<p><strong id="results">' . $RESULTS . '</strong> results</p>

				<div id="successposition"><div id="success"></div></div>
			</main>
			<footer>
				<p>powered by <a target="_blank" href="https://www.winterstein.one">winterstein.one</a></p>
			</footer>
		</div>
	</body>
</html>';

echo $HTML;
