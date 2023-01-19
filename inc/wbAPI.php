<?php
// database query API with parameters "lang" and "query" (spr and bst for now)
// lang can be "hoog" and "plat" and tells the API the sorting order
// query will fetch words beginning with char if length = 1 and char part of tablemap
// else (length >1) all tables will be searched for query string

function wbQuery($lang, $query) {

// database login credentials are loaded from a cfg file away from public access
$dbconfig = parse_ini_file('../../private/config.ini');	

echo "<table class=\"tbanzeige\">";
if ($lang == 'hoog') { 
	$dbquery = " 
		SELECT hoog, plat FROM ".$query." UNION
		SELECT hoog, plat FROM avb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM bvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM cvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM dvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM evb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM fvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM gvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM hvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM ivb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM jvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM kvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM lvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM mvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM nvb WHERE LEFT(hoog,1) = '".$query."' UNION		 
		SELECT hoog, plat FROM ovb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM pvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM rvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM svb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM tvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM uvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM vvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM wvb WHERE LEFT(hoog,1) = '".$query."' UNION
		SELECT hoog, plat FROM zvb WHERE LEFT(hoog,1) = '".$query."' ORDER BY hoog";
	try {
		$dbhandle = new PDO ("mysql:dbname=".$dbconfig['dbname']."; host=".$dbconfig['servername'], 
								$dbconfig['username'], $dbconfig['password']);
		$dbresult = $dbhandle->query($dbquery);
		$dbhandle = null;
	}
	catch(PDOException $e) { echo $e->getMessage(); }
	echo "	<tr>
				<th>hoog</th>
				<th>plat</th>
			</tr>";
	foreach ($dbresult as $row) {
		echo "	<tr>
					<td>{$row['hoog']}</td>
					<td>{$row['plat']}</td>
				</tr>";
	}
}	
elseif ($lang == 'plat') {
	$dbquery = "
		SELECT hoog, plat FROM ".$query."vb UNION 
		SELECT hoog, plat FROM a WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM b WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM c WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM d WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM e WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM f WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM g WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM h WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM i WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM j WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM k WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM l WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM m WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM n WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM o WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM p WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM q WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM r WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM s WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM t WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM u WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM v WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM w WHERE LEFT(plat,1) = '".$query."' UNION
		SELECT hoog, plat FROM z WHERE LEFT(plat,1) = '".$query."' ORDER BY plat";
	try {
		$dbhandle = new PDO ("mysql:dbname=".$dbconfig['dbname']."; host=".$dbconfig['servername'], 
														$dbconfig['username'], $dbconfig['password']);
		$dbresult = $dbhandle->query($dbquery);
		$dbhandle = null;			
	}
	catch(PDOException $e) { echo $e->getMessage(); }
	echo "	<tr>
				<th>plat</th>
				<th>hoog</th>
			</tr>";
	foreach ($dbresult as $row) {
		echo "	<tr>
					<td>{$row['plat']}</td>
					<td>{$row['hoog']}</td>
				</tr>";
	}
}
else { echo "Doa häwwe wy nex to gefone."; }
echo "</table>";
}

?>