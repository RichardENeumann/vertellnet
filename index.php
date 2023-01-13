<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wörterbuch für Duisburger Platt - Wöörtbuuk vör Düsbergsch Plat</title>
	<meta name="description" content="ein Wörterbuch für die niederfränkischen Dialekte des Duisburger Stadtgebiets">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<header>
		<ul class="logo">
			<li><h1>Plat en<br>Düsberg</h1></li>
			<li><img src="gfx/rheinlogo.svg" alt="Logo mit Rhein"></li>
		</ul>
	</header>
	<nav>
		[ <a href="einfuehrung.html">Infürong</a> - <a href="index.php">Wöörtbuuk</a> ]
	</nav>
	<hr>
	<main>
		<div class="suchleiste">
			<form action="">
				<input type="text" name="suche" placeholder="Süke geet noch ni">
				<button type="submit">Los!</button>
			</form>
		</div>
		<div class="sprachwahl">
			[ <?php include 'inc/sp_auswahl.php'; ?> ]
		</div>
		<div class="buchstabenliste">
			<?php include 'inc/bs_auswahl.php';	?>
		</div> 
		<div class="wortliste">	
			<table>
				<?php include 'inc/db_abfrage.php';	?>
			</table>
		</div>
	</main>
	<hr>
	<footer>
		<small>&copy 2021<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>