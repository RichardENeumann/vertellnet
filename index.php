<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wörterbuch für Duisburger Platt - Wöörtbuuk vör Düsbergsch Plat</title>
	<meta name="description" content="ein Wörterbuch für die niederfränkischen Dialekte des Duisburger Stadtgebiets">
	<link href="css/style.css" rel="stylesheet">
	<?php 
		require("inc/wbAPI.php");
		require("inc/wbBuildNav.php");

		// validate GET params on page load
		$_GET['query'] = isset($_GET['query'])? $_GET['query'] : 'a';

		$_GET['lang'] = isset($_GET['lang']) ? $_GET['lang'] : 'hoog';
		$_GET["lang"] = preg_match("/plat|hoog/i", $_GET["lang"]) ? $_GET["lang"] : "hoog";

		$_GET['rType'] = isset($_GET['rType']) ? $_GET['rType'] : 'html';
		$_GET["rType"] = preg_match("/html|/i", $_GET["rType"]) ? $_GET["rType"] : "html";
	?>
</head>
<body>
	<header>
		<h1>Plat en<br>Düsberg</h1>
		<img src="gfx/rheinlogo.svg" alt="Logo mit Rhein">
	</header>
	<nav>
		[ <a href="einfuehrung.html">Infürong</a> - <a href="index.php">Wöörtbuuk</a> ]
	</nav>
	<hr>
	<main>
		<div class="suchleiste">
			<?php wbBuildSearch(); ?>
		</div>
		<br>
		<div class="sprachwahl">
			[ <?php wbBuildLang(); ?> ]
		</div>
		<br>
		<div class="buchstabenliste">
			<?php wbBuildLetter(); ?>
		</div> 
		<br>
		<?php wbParseRequest($_GET['lang'], $_GET['query'], $_GET['rType']); ?>
	</main>
	<hr>
	<footer>
		<small>&copy; 2023<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>