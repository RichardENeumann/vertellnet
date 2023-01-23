<?php
// declare(strict_types=1); 
// API Database Query Parameters: 
// 'lang' = string: 'hoog' || 'plat' determines how to query db
// 'query' = string: search string; if length=1 fetch by starting letter, else search whole wb in hoog || plat for string
// 'rType' = string: 'html' || 'json' returns result as html string or json object (when called from javascript)

// Check if the request contains workable variables
function wbParseRequest($lang, $query, $rType) {
	wbFetchResult($lang, $query, $rType);
}
// Get request from the database
function wbFetchResult($lang, $query, $rType) {

// Database credentials are loaded from outside of public web access
$dbConfig = parse_ini_file('../../private/config.ini');	

// For synergy reasons the spreadsheet verb tables hoog/plat order was the 
// wrong way around before a proper db was built. 
// It takes time to sort through 800+ verbs plus conjugations,
// Queries via 'hoog' will be faster once sorted properly
if ($lang == 'hoog') { 
	$dbQuery = '
		SELECT hoog, plat FROM '.$query.' UNION
		SELECT hoog, plat FROM avb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM bvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM cvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM dvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM evb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM fvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM gvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM hvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM ivb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM jvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM kvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM lvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM mvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM nvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM ovb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM pvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM rvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM svb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM tvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM uvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM vvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM wvb WHERE LEFT(hoog,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM zvb WHERE LEFT(hoog,1) = "'.$query.'" ORDER BY hoog';
	try {
		$dbHandle = new PDO ('mysql:dbname='.$dbConfig['dbname'].'; host='.$dbConfig['servername'], 
								$dbConfig['username'], $dbConfig['password']);
		$dbResult = $dbHandle->query($dbQuery);
		$dbHandle = null;
	}
	catch(PDOException $e) { echo $e->getMessage(); }
}	
elseif ($lang == 'plat') {
	$dbQuery = '
		SELECT hoog, plat FROM '.$query.'vb UNION 
		SELECT hoog, plat FROM a WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM b WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM c WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM d WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM e WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM f WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM g WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM h WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM i WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM j WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM k WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM l WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM m WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM n WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM o WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM p WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM q WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM r WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM s WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM t WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM u WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM v WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM w WHERE LEFT(plat,1) = "'.$query.'" UNION
		SELECT hoog, plat FROM z WHERE LEFT(plat,1) = "'.$query.'" ORDER BY plat';
	try {
		$dbHandle = new PDO ('mysql:dbname='.$dbConfig['dbname'].'; host='.$dbConfig['servername'],
														$dbConfig['username'], $dbConfig['password']);
		$dbResult = $dbHandle->query($dbQuery);
		$dbHandle = null;			
	}
	catch(PDOException $e) { echo $e->getMessage(); }
}
wbReturnResult($lang, $dbResult, $rType);
}

// Herein the results will be returned as either html string or a json object, depending on rType
function wbReturnResult($lang, $dbResult, $rType) {
$rType = 'html';
if ($rType == 'html') {
	echo '<table class="tbanzeige">';
	if ($lang == 'hoog') {
		echo '	<tr>
					<th>hoog</th>
					<th>plat</th>
				</tr>';
		ob_start(null, 4096);		
		foreach ($dbResult as $row) {
			echo '	<tr>
						<td>'.$row['hoog'].'</td>
						<td>'.$row['plat'].'</td>
					</tr>';
		}
		ob_end_flush();
	}
	elseif ($lang == 'plat') {
		echo '	<tr>
					<th>plat</th>
					<th>hoog</th>
				</tr>';
		ob_start(null, 4096);
		foreach ($dbResult as $row) {
			echo '	<tr>
						<td>'.$row['plat'].'</td>
						<td>'.$row['hoog'].'</td>
					</tr>';
		}
		ob_end_flush();
	}
	else { echo 'Doa häwwe wy nex to gefone.'; }	
	echo '</table>';	
}
else { echo 'json is coming for you'; }
}
?>