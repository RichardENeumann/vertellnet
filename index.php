<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wörterbuch für Duisburger Platt - Wöörtbuuk vör Düsbergsch Plat</title>
	<meta name="description" content="ein Wörterbuch für die niederfränkischen Dialekte des Duisburger Stadtgebiets">
	<link href="style/base.css" rel="stylesheet">
	<link type="image/png" sizes="16x16" rel="icon" href="graphics/icons8-buch-3d-fluency-16.png">
	<link type="image/png" sizes="32x32" rel="icon" href="graphics/icons8-buch-3d-fluency-32.png">
	<?php 
		
			
		// Validate GET parameters on page load
		$_GET["q"] = isset($_GET["q"])? $_GET["q"] : "a";
		$_GET["l"] = isset($_GET["l"]) ? $_GET["l"] : "hoog";
		$_GET["l"] = preg_match("/^plat$|^hoog$/i", $_GET["l"]) ? $_GET["l"] : "hoog";
	?>
</head>
<body>
	<header>
		<h1>Plat en<br>Düsberg</h1>
		<img src="graphics/rheinlogo.svg" alt="Logo mit Rhein">
	</header>
	<nav>
		[ <a href="einfuehrung.html">Infürong</a> - <a href="index.php">Wöörtbuuk</a> ]
	</nav>
	<hr>
	<main>
		<form action="">
			<?php 
				echo '<input type="hidden" name="l" value="'.$_GET["l"].'">';
				echo '<input type="text" name="q" placeholder="max. 20 Buukschtawe..." 
					pattern="[A-Za-zäüö]{1,20}" value="'.$_GET["q"].'">';
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
				echo '<a href="index.php?l='.$_GET["lang"].'&q=a">A</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=b">B</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=c">C</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=d">D</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=e">E</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=f">F</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=g">G</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=h">H</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=i">I</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=j">J</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=k">K</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=l">L</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=m">M</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=n">N</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=o">O</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=p">P</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=q">Q</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=r">R</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=s">S</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=t">T</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=u">U</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=v">V</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=w">W</a> ';
				echo '<a href="index.php?l='.$_GET["lang"].'&q=z">Z</a> ';
			?>
		</div> 
		<?php 
			$response = file_get_contents("https://vertell.net/search/".$_GET["l"]."/".$_GET["q"]);
			echo $response;
		?>
	</main>
	<hr>
	<footer>
		<small>&copy; 2023<br><a href="impressum.html">Empressom</a></small>
	</footer>
</body>
</html>