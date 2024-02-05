<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wörterbuch für Duisburger Platt - Wöörtbuuk vör Düsbergsch Plat</title>
	<meta name="description" content="ein Wörterbuch für die niederfränkischen Dialekte des Duisburger Stadtgebiets">
	<link href="style/base.css" rel="stylesheet">
	<link type="image/png" sizes="16x16" rel="icon" href="images/icons8-buch-3d-fluency-16.png">
	<link type="image/png" sizes="32x32" rel="icon" href="images/icons8-buch-3d-fluency-32.png">
	<?php 
		// Validate GET parameters on page load
		$_GET["q"] = isset($_GET["q"])? $_GET["q"] : "A";
		$_GET["l"] = isset($_GET["l"]) ? $_GET["l"] : "hoog";
		$_GET["l"] = preg_match("/^plat$|^hoog$/i", $_GET["l"]) ? $_GET["l"] : "hoog";
	?>
</head>
<body>
	<header>
		<a href="/">
			<h1>Plat en<br>Düsberg</h1>
			<img src="images/rheinlogo.svg" alt="Logo mit Rhein">
		</a>
	</header>
	<nav>
		[ <a href="einfuehrung.html">Infürong</a> - <a href="index.php">Wöörtbuuk</a> ]
	</nav>
	<hr>
	<main>
		<form action="index.php">
			<?php 
				echo '<input type="hidden" name="l" value="'.$_GET["l"].'">';
				echo '<input type="text" name="q" placeholder="max. 20 Buukschtawe..." 
					pattern="[A-Za-zßäüö\s]{1,20}" value="'.$_GET["q"].'">';
			?>		
			<button type="submit">Süke!</button>
		</form>
		<div class="langselector">
			<?php 
				echo "[ <a href=\"index.php?l=hoog&q=".$_GET["q"]."\">Hoog</a> - ";
				echo "<a href=\"index.php?l=plat&q=".$_GET["q"]."\">Plat</a> ]";
			?>
		</div>
		<div class="letterselector">
			<?php 
				echo '<a href="index.php?l='.$_GET["l"].'&q=A">A</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=B">B</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=C">C</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=D">D</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=E">E</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=F">F</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=G">G</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=H">H</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=I">I</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=J">J</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=K">K</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=L">L</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=M">M</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=N">N</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=O">O</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=P">P</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=Q">Q</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=R">R</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=S">S</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=T">T</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=U">U</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=V">V</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=W">W</a> ';
				echo '<a href="index.php?l='.$_GET["l"].'&q=Z">Z</a> ';
			?>
		</div> 
		<?php 
			require("logic/wb.php");
			wbParseRequest($_GET["l"], $_GET["q"]);
		//	$response = file_get_contents("https://vertell.net/search/".$_GET["l"]."/".$_GET["q"]);
		//	echo $response;
		?>
	</main>
	<hr>
	<footer>
		<small>&copy; 2023<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>