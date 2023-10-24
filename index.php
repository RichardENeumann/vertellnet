<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wörterbuch für Duisburger Platt - Wöörtbuuk vör Düsbergsch Plat</title>
	<meta name="description" content="ein Wörterbuch für die niederfränkischen Dialekte des Duisburger Stadtgebiets">
	<link href="css/style.css" rel="stylesheet">
	<link type="image/png" sizes="16x16" rel="icon" href="gfx/icons8-buch-3d-fluency-16.png">
	<link type="image/png" sizes="32x32" rel="icon" href="gfx/icons8-buch-3d-fluency-32.png">
	<?php 
		require("inc/wbAPI.php");
		
		// Validate GET parameters on page load
		$_GET["search"] = isset($_GET["search"])? $_GET["search"] : "a";

		$_GET["lang"] = isset($_GET["lang"]) ? $_GET["lang"] : "hoog";

		$_GET["lang"] = preg_match("/^plat$|^hoog$/i", $_GET["lang"]) ? $_GET["lang"] : "hoog";

		$_GET["return"] = "html";
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
		<form action="">
			<input type="text" name="search" placeholder="max. 20 Buukschtawe..." pattern="[A-Za-zäüö]{1,20}">
			<?php 
				echo "<input type=\"hidden\" name=\"lang\" value=\"".$_GET["lang"]."\">";
			?>
			<button type="submit">Süke!</button>
		</form>
		<div class="langselector">
			<?php 
				echo "[ <a href=\"index.php?search=".$_GET["search"]."&lang=hoog\">Hoog</a> - ";
				echo "<a href=\"index.php?search=".$_GET["search"]."&lang=plat\">Plat</a> ]";
			?>
		</div>
		<div class="letterselector">
			<?php 
				echo "<a href=\"index.php?search=a&lang=".$_GET["lang"]."\">A</a> ";
				echo "<a href=\"index.php?search=b&lang=".$_GET["lang"]."\">B</a> ";
				echo "<a href=\"index.php?search=c&lang=".$_GET["lang"]."\">C</a> ";
				echo "<a href=\"index.php?search=d&lang=".$_GET["lang"]."\">D</a> ";
				echo "<a href=\"index.php?search=e&lang=".$_GET["lang"]."\">E</a> ";
				echo "<a href=\"index.php?search=f&lang=".$_GET["lang"]."\">F</a> ";
				echo "<a href=\"index.php?search=g&lang=".$_GET["lang"]."\">G</a> ";
				echo "<a href=\"index.php?search=h&lang=".$_GET["lang"]."\">H</a> ";
				echo "<a href=\"index.php?search=i&lang=".$_GET["lang"]."\">I</a> ";
				echo "<a href=\"index.php?search=j&lang=".$_GET["lang"]."\">J</a> ";
				echo "<a href=\"index.php?search=k&lang=".$_GET["lang"]."\">K</a> ";
				echo "<a href=\"index.php?search=l&lang=".$_GET["lang"]."\">L</a> ";
				echo "<a href=\"index.php?search=m&lang=".$_GET["lang"]."\">M</a> ";
				echo "<a href=\"index.php?search=n&lang=".$_GET["lang"]."\">N</a> ";
				echo "<a href=\"index.php?search=o&lang=".$_GET["lang"]."\">O</a> ";
				echo "<a href=\"index.php?search=p&lang=".$_GET["lang"]."\">P</a> ";
				echo "<a href=\"index.php?search=q&lang=".$_GET["lang"]."\">Q</a> ";
				echo "<a href=\"index.php?search=r&lang=".$_GET["lang"]."\">R</a> ";
				echo "<a href=\"index.php?search=s&lang=".$_GET["lang"]."\">S</a> ";
				echo "<a href=\"index.php?search=t&lang=".$_GET["lang"]."\">T</a> ";
				echo "<a href=\"index.php?search=u&lang=".$_GET["lang"]."\">U</a> ";
				echo "<a href=\"index.php?search=v&lang=".$_GET["lang"]."\">V</a> ";
				echo "<a href=\"index.php?search=w&lang=".$_GET["lang"]."\">W</a> ";
				echo "<a href=\"index.php?search=z&lang=".$_GET["lang"]."\">Z</a> ";
			?>
		</div> 
		<?php wbParseRequest($_GET["search"], $_GET["lang"], $_GET["return"]); ?>
	</main>
	<hr>
	<footer>
		<small>&copy; 2023<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>