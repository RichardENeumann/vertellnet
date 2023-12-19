<?php
// Allowed characters for querying database by single letter
define("ALLOWEDCHARS", "abcdefghijklmnopqrstuvwz");

function wbParseRequestAPI($lang, $query) {
	if (preg_match("/^hoog$|^plat$/i", $lang) && 
		preg_match("/[a-zßäüö\s]{1,20}/i", $query)) {
		$lang = strtolower($lang);
		$query = strtolower($query);
		switch (strlen($query)) {
			case 0:
				http_response_code(400);
				echo "Van neks komt neks. (Empty query)";
				break;
			case 1:
				if (preg_match("/".$query."/", ALLOWEDCHARS)) { 
					wbFetchResultAPI($lang, $query); 
				} 
				else { 
					http_response_code(400);
					echo "Dat kenne wy niet. (No words starting with that letter in database)"; 
				}
				break;
			default:
				wbFetchResultAPI($lang, $query);
				break;
		}	
	} else {
		http_response_code(400);
		echo "Dat kenne wy niet. (Query malformed)";
	}	
}

function wbFetchResultAPI($lang, $query) {
	if (strlen($query) == 1) { 
		$exp = $query . "%";
	}	
	else { 
		$exp = "%" . $query . "%"; 
	}	
	$dbQuery = "
		(SELECT hoog, plat FROM a WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM b WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM c WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM d WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM e WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM f WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM g WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM h WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM i WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM j WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM k WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM l WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM m WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM n WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM o WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM p WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM q WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM r WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM s WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM t WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM u WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM v WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM w WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM z WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM avb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM bvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM cvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM dvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM evb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM fvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM gvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM hvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM ivb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM jvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM kvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM lvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM mvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM nvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM ovb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM pvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM rvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM svb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM tvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM uvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM vvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM wvb WHERE " . $lang . " LIKE '" . $exp . "') UNION
		(SELECT hoog, plat FROM zvb WHERE " . $lang . " LIKE '" . $exp . "') ORDER BY " . $lang;

	// Database credentials are loaded from outside of public web access
	$dbConfig = parse_ini_file(__DIR__."/../../private/config.ini");		
	
	$dbHandle = new mysqli($dbConfig["servername"], $dbConfig["username"],
		$dbConfig["password"], $dbConfig["dbname"]);
	if ($dbHandle->connect_errno) {
		http_response_code(500);
		die("Verbendong geit ni. (Database Error)");
	}
	$dbResult = $dbHandle->query($dbQuery);
	$dbHandle = null;
	wbReturnResultAPI($lang, $dbResult);
}

function wbReturnResultAPI($lang, $dbResult) {
	// Prepare results as array
	$result = $dbResult->fetch_all(MYSQLI_NUM);
	// Serve up results
	ob_start();
	if (empty($result)) {
		http_response_code(204);
		echo "Doa häwwe wy neks för gefone. (Query successful, nothing found)";
	} else if ($lang === "hoog") {
		http_response_code(200);
		echo "<table>";
		echo "<tr><th>Hoog</th><th>Plat</th></tr>"; 
		foreach ($result as $key) {
			echo "<tr><td>".$key[0]."</td><td>".$key[1]."</td></tr>";	
		}
		echo "</table>";	
	} else if ($lang === "plat") {
		http_response_code(200);
		echo "<table>";
		echo "<tr><th>Plat</th><th>Hoog</th></tr>";	
		foreach ($result as $key) {
			echo "<tr><td>".$key[1]."</td><td>".$key[0]."</td></tr>";	
		}
		echo "</table>";	
	}
	ob_end_flush();
	$result = null;
}

if ($_SERVER["REQUEST_METHOD"] != "GET") {
	http_response_code(405);
	echo "Dat dörwe Chy niet! (Method not allowed)";
} else if (!isset($_GET["l"]) || !isset($_GET["q"])) {
	http_response_code(400);
	echo "So geit dat ni. (Malformed or empty query)";
} else {
	wbParseRequestAPI($_GET["l"], $_GET["q"]);
}