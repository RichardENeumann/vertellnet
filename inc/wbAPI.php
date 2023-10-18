<?php declare(strict_types=1); 
// allowed chars for browsing database by single letter
define("ALLOWEDCHARS", "abcdefghijklmnopqrstuvwz");

// validate request params
function wbParseRequest($lang, $query, $rType) {
	$lang = (preg_match("/hoog|plat/i", $lang)) ? $lang : "hoog";
	$rType = (preg_match("/html|xml|json/i", $rType)) ? $rType : 'html';
	switch (strlen($query)) {
		case 0:
			echo "Van neks komt neks." ;
			break;
		case 1:
			if (preg_match('/'.$query.'/i', ALLOWEDCHARS)) { 
				wbFetchResult($lang, $query, $rType); 
			} 
			else { 
				echo "Dat kenne wy niet."; 
			}
			break;
		default:
			wbFetchResult($lang, $query, $rType);
			break;
	}		
}

// Get request from the database
function wbFetchResult($lang, $query, $rType) {
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
		$dbHandle = new PDO ('mysql:dbname='.$dbConfig['dbname'].'; host='.$dbConfig['servername'], 
			$dbConfig['username'], $dbConfig['password']);
		$dbResult = $dbHandle->query($dbQuery);
		$dbHandle = null;
	}
	catch(PDOException $e) { echo $e->getMessage(); }
	wbReturnResult($lang, $dbResult, $rType);
}

function wbReturnResult($lang, $dbResult, $rType) {
	$result = [];
	if (preg_match("/hoog/i", $lang)) {
		foreach ($dbResult as $row) {
			$result[$row["hoog"]] = $row["plat"];
		}
	} else if (preg_match("/plat/i", $lang)) {
		foreach ($dbResult as $row) {
			$result[$row["plat"]] = $row["hoog"];
		}
	}
	if ($rType === "html") {
		ob_start();
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
		ob_end_flush();
	} else if ($rType === "json") { 
		$jsonResponse = json_encode($result);
		header("Content-Type:application/json");
		echo $jsonResponse;
	} else if ($rType === "xml") {
		//$xmlResponse = new SimpleXMLElement();
		// array_walk_recursive($result, array ($xmlResponse, "addChild"));
		// header("Content-Type:application/xml");
		// echo $xmlResponse;
		echo "XML";
	}	
}
?>