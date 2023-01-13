<?php

include 'gina.php';

$db = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
	printf("Verbindung zur Datenbank fehlgeschlagen: <br> %s <br>", mysqli_connect_error());
}

if ($_GET['spr'] == 'hoog') { 
	$anfrage = mysqli_query($db, 
		"SELECT hoog, plat FROM " . $_GET['bst'] . "
		 UNION ALL
		 SELECT hoog, plat FROM avb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM bvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM cvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM dvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM evb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM fvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM gvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM hvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM ivb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM jvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM kvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM lvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM mvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM nvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM ovb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM pvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM qvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM rvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM svb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM tvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM uvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM vvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM wvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM zvb WHERE LEFT(hoog,1) = '" . $_GET['bst'] . "'
		 ORDER BY hoog")	
		or die (mysqli_error($db));
	echo "	<tr>
				<th>hoog</th>
				<th>plat</th>
			</tr>";
	while ($reihe = mysqli_fetch_array($anfrage)) {
		$reihenklasse = ($reihenklasse=='alt1') ? 'alt2' : 'alt1';
		echo "	<tr class=\"{$reihenklasse}\">
					<td>{$reihe['hoog']}</td>
					<td>{$reihe['plat']}</td>
				</tr>";
	}
}	
else {
	$anfrage = mysqli_query($db, 
		"SELECT hoog, plat FROM " . $_GET['bst'] . "vb UNION ALL 
		 SELECT hoog, plat FROM a WHERE LEFT(plat,1) = '" . $_GET['bst'] . "'
		 UNION ALL
		 SELECT hoog, plat FROM b WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM c WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM d WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM e WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM f WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM g WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM h WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM i WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM j WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM k WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM l WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM m WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM n WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM o WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM p WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM q WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM r WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM s WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM t WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM u WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM v WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 UNION ALL
		 SELECT hoog, plat FROM w WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
 		 UNION ALL
		 SELECT hoog, plat FROM z WHERE LEFT(plat,1) = '" . $_GET['bst'] . "' 
		 ORDER BY plat") or die (mysqli_error($db));
	echo "	<tr>
				<th>plat</th>
				<th>hoog</th>
			</tr>"; 
	while ($reihe = mysqli_fetch_array($anfrage)) {
		$reihenklasse = ($reihenklasse=='alt1') ? 'alt2' : 'alt1';
		echo "	<tr class=\"{$reihenklasse}\">
					<td>{$reihe['plat']}</td>
					<td>{$reihe['hoog']}</td>
				</tr>";
	}	
}


?>