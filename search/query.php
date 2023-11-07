<?php
// Allowed characters for querying database by single letter
define("ALLOWEDCHARS", "abcdefghijklmnopqrstuvwz");

function wbParseRequest($lang, $query) {
	if (preg_match("/^hoog$|^plat$/i", $lang) && 
		preg_match("/[a-zäüö]{1,20}/i", $query)) {
		$lang = strtolower($lang);
		$query = strtolower($query);
		switch (strlen($query)) {
			case 0:
				http_response_code(400);
				echo "Van neks komt neks. (Empty query)";
				break;
			case 1:
				if (preg_match("/".$query."/", ALLOWEDCHARS)) { 
					wbFetchResult($lang, $query); 
				} 
				else { 
					http_response_code(400);
					echo "Dat kenne wy niet. (No words starting with that letter in database)"; 
				}
				break;
			default:
				wbFetchResult($lang, $query);
				break;
		}	
	} else {
		http_response_code(400);
		echo "Dat kenne wy niet. (Query malformed)";
	}	
}

function wbFetchResult($lang, $query) {
	// Database credentials are loaded from outside of public web access
	$dbConfig = parse_ini_file('../../private/config.ini');	
	if (strlen($query) == 1) { 
		$exp = $query.'%';
	}	
	else { 
		$exp = '%'.$query.'%'; 
	}	
	$dbQuery = '
		SELECT hoog, plat FROM a WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM b WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM c WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM d WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM e WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM f WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM g WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM h WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM i WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM j WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM k WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM l WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM m WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM n WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM o WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM p WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM q WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM r WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM s WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM t WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM u WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM v WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM w WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM z WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM avb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM bvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM cvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM dvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM evb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM fvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM gvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM hvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM ivb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM jvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM kvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM lvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM mvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM nvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM ovb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM pvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM rvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM svb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM tvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM uvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM vvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM wvb WHERE '.$lang.' LIKE "'.$exp.'" UNION
		SELECT hoog, plat FROM zvb WHERE '.$lang.' LIKE "'.$exp.'" ORDER BY '.$lang;
	try {
		$dbHandle = new PDO('mysql:dbname='.$dbConfig['dbname'].'; host='.$dbConfig['servername'], 
			$dbConfig['username'], $dbConfig['password']);
		$dbResult = $dbHandle->query($dbQuery);
		$dbHandle = null;
		wbReturnResult($lang, $dbResult);
	}
	catch(PDOException $e) { 
 		echo $e->getMessage()."<br>"; 
		http_response_code(500);
		echo "Doa ös wat scheef gegonge. (Try again later)";
	}
}

function wbReturnResult($lang, $dbResult) {
	// Prepare results as array
	$result = [];
	if ($lang == "hoog") {
		foreach ($dbResult as $row) {
			$result[$row["hoog"]] = $row["plat"];
		}
	} else {
		foreach ($dbResult as $row) {
			$result[$row["plat"]] = $row["hoog"];
		}
	}
	// Serve up results
	ob_start();
		if (empty($result)) {
			http_response_code(204);
			echo "Doa häwwe wy neks för gefone. (Query successful, no results)";
		} else {
			http_response_code(200);
			echo "<table>";
			echo $title = (preg_match("/hoog/i", $lang)) ? 
			"<tr><th>Hoog</th><th>Plat</th></tr>" : 
			"<tr><th>Plat</th><th>Hoog</th></tr>";	
			foreach ($result as $key => $value) {
				echo "	<tr>
							<td>".$key."</td><td>".$value."</td>
						</tr>";	
			}
			echo "</table>";	
		}	
		ob_end_flush();
}

if ($_SERVER["REQUEST_METHOD"] != "GET") {
	http_response_code(405);
	echo "Dat dörfe Chej niet! (Method not allowed)";
} else {
	if (isset($_GET["l"]) && isset($_GET["q"])) {
		wbParseRequest($_GET["l"], $_GET["q"]);
	} else {
		http_response_code(400);
		echo "So geet dat ni. (Malformed or empty query)";
	}
}