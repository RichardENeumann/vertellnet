<?php declare(strict_types=1); ?>
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
		
		// validate GET params on page load
		$_GET["query"] = isset($_GET["query"])? $_GET["query"] : "a";

		$_GET["lang"] = isset($_GET["lang"]) ? $_GET["lang"] : "hoog";
		$_GET["lang"] = preg_match("/plat|hoog/i", $_GET["lang"]) ? $_GET["lang"] : "hoog";

		$_GET["rType"] = "html";
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
			<input type="text" name="query" placeholder="(max. 20 Buchstaben)" pattern="[A-Za-zäüö]{1,20}">
			<?php 
				echo "<input type=\"hidden\" name=\"lang\" value=\"".$_GET["lang"]."\">";
			?>
			<button type="submit">Süke!</button>
		</form>
		<div class="langselector">
			<?php 
				echo "[ <a href=\"index.php?query=".$_GET["query"]."&lang=hoog\">Hoog</a> - ";
				echo "<a href=\"index.php?query=".$_GET["query"]."&lang=plat\">Plat</a> ]";
			?>
		</div>
		<div class="letterselector">
			<?php 
				echo "<a href=\"index.php?query=a&lang=".$_GET["lang"]."\">A</a>";
				echo "<a href=\"index.php?query=b&lang=".$_GET["lang"]."\">B</a>";
				echo "<a href=\"index.php?query=c&lang=".$_GET["lang"]."\">C</a>";
				echo "<a href=\"index.php?query=d&lang=".$_GET["lang"]."\">D</a>";
				echo "<a href=\"index.php?query=e&lang=".$_GET["lang"]."\">E</a>";
				echo "<a href=\"index.php?query=f&lang=".$_GET["lang"]."\">F</a>";
				echo "<a href=\"index.php?query=g&lang=".$_GET["lang"]."\">G</a>";
				echo "<a href=\"index.php?query=h&lang=".$_GET["lang"]."\">H</a>";
				echo "<a href=\"index.php?query=i&lang=".$_GET["lang"]."\">I</a>";
				echo "<a href=\"index.php?query=j&lang=".$_GET["lang"]."\">J</a>";
				echo "<a href=\"index.php?query=k&lang=".$_GET["lang"]."\">K</a>";
				echo "<a href=\"index.php?query=l&lang=".$_GET["lang"]."\">L</a>";
				echo "<a href=\"index.php?query=m&lang=".$_GET["lang"]."\">M</a>";
				echo "<a href=\"index.php?query=n&lang=".$_GET["lang"]."\">N</a>";
				echo "<a href=\"index.php?query=o&lang=".$_GET["lang"]."\">O</a>";
				echo "<a href=\"index.php?query=p&lang=".$_GET["lang"]."\">P</a>";
				echo "<a href=\"index.php?query=q&lang=".$_GET["lang"]."\">Q</a>";
				echo "<a href=\"index.php?query=r&lang=".$_GET["lang"]."\">R</a>";
				echo "<a href=\"index.php?query=s&lang=".$_GET["lang"]."\">S</a>";
				echo "<a href=\"index.php?query=t&lang=".$_GET["lang"]."\">T</a>";
				echo "<a href=\"index.php?query=u&lang=".$_GET["lang"]."\">U</a>";
				echo "<a href=\"index.php?query=v&lang=".$_GET["lang"]."\">V</a>";
				echo "<a href=\"index.php?query=w&lang=".$_GET["lang"]."\">W</a>";
				echo "<a href=\"index.php?query=z&lang=".$_GET["lang"]."\">Z</a>";
			?>
		</div> 
		<?php wbParseRequest($_GET["query"], $_GET["lang"], $_GET["rType"]); ?>
	</main>
	<hr>
	<footer>
		<small>&copy; 2023<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>