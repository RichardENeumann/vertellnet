<?php
// Check and initialize GET params
$_GET['lang'] = isset($_GET['lang']) ? $_GET['lang'] : 'hoog';
$_GET['query'] = isset($_GET['query'])? $_GET['query'] : 'a';
$_GET['rType'] = isset($_GET['rType']) ? $_GET['rType'] : 'html';

// Build the search box
function wbBuildSearch() {
	echo '<form action="">';
	echo '<input type="hidden" name=lang value="'.$_GET['lang'].'"></input>';
	echo '<input type="text" name="query" placeholder="Süke..."> ';
	echo '<input type="hidden" name=rType value="'.$_GET['rType'].'"></input>';
	echo '<button type="submit">Los!</button>';
	echo '</form>';
}

// Build the language selector
function wbBuildLang() { 
	echo '<a href="?lang=hoog&amp;query='.$_GET['query'].'&amp;rType=html">hoog</a> - ';
	echo '<a href="?lang=plat&amp;query='.$_GET['query'].'&amp;rType=html">plat</a>';
}

// Build the letter selector
function wbBuildLetter() {
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=a&amp;rType=html">A</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=b&amp;rType=html">B</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=c&amp;rType=html">C</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=d&amp;rType=html">D</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=e&amp;rType=html">E</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=f&amp;rType=html">F</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=g&amp;rType=html">G</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=h&amp;rType=html">H</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=i&amp;rType=html">I</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=j&amp;rType=html">J</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=k&amp;rType=html">K</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=l&amp;rType=html">L</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=m&amp;rType=html">M</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=n&amp;rType=html">N</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=o&amp;rType=html">O</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=p&amp;rType=html">P</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=q&amp;rType=html">Q</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=r&amp;rType=html">R</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=s&amp;rType=html">S</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=t&amp;rType=html">T</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=u&amp;rType=html">U</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=v&amp;rType=html">V</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=w&amp;rType=html">W</a> ';
	echo '<a href="?lang='.$_GET['lang'].'&amp;query=z&amp;rType=html">Z</a> ';
}
?>