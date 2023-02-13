<?php // declare(strict_types=1); 
// API Database Query Parameters: 
// 'lang' = string: 'hoog' || 'plat' determines which way around to query the database
// 'query' = string: search string; if length=1 fetch by starting letter, else search whole wb in hoog || plat for string
// 'rType' = string: 'html' || 'json' returns result as html string or json object (when called from javascript)

// allowed chars for browsing database by single letter
define("ALLOWEDCHARS", "abcdefghijklmnopqrstuvwz");

// initialize and validate GET params on first page load
$_GET['lang'] = isset($_GET['lang']) ? $_GET['lang'] : 'hoog';
$_GET['lang'] = ($_GET['lang'] == 'plat') ? 'plat' : 'hoog';
$_GET['query'] = isset($_GET['query'])? $_GET['query'] : 'a';
$_GET['rType'] = isset($_GET['rType']) ? $_GET['rType'] : 'html';
$_GET['rType'] = ($_GET['rType'] == 'json') ? 'json' : 'html';

// validate request params
function wbParseRequest($lang, $query, $rType) {
	$lang = ($lang == 'plat') ? 'plat' : 'hoog';
	$rType = ($rType == 'json') ? 'json' : 'html';
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

// Herein the results will be returned as either html string or a json object, depending on rType
function wbReturnResult($lang, $dbResult, $rType) {
	if ($rType == 'html') {
		echo '<table class="tbanzeige">';
		if ($lang == 'hoog') {
			echo '	<tr>
						<th>hoog</th>
						<th>plat</th>
					</tr>';
			ob_start();		
			foreach ($dbResult as $row) {
				echo '		<tr>
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
			ob_start();
			foreach ($dbResult as $row) {
				echo '<tr>
					<td>'.$row['plat'].'</td>
					<td>'.$row['hoog'].'</td>
				</tr>';
			}
			ob_end_flush();
		}
		else { echo 'Doa häwwe wy neks to gefone.'; }	
		echo '</table>';	
	}
	else { echo 'here be json soon'; }	
}
?>