<?php
$dbWordCount = 0;
$dbVerbCount = 0;

function wbGetCount() {
    global $dbWordCount, $dbVerbCount;

    $dbConfig = parse_ini_file(__DIR__."/../../private/config.ini");
    
    $dbQueryWords = "
        WITH letterCounts AS
            (SELECT COUNT(hoog) AS counts FROM a UNION ALL 
            SELECT COUNT(hoog) FROM b UNION ALL
            SELECT COUNT(hoog) FROM c UNION ALL
            SELECT COUNT(hoog) FROM d UNION ALL
            SELECT COUNT(hoog) FROM e UNION ALL
            SELECT COUNT(hoog) FROM f UNION ALL
            SELECT COUNT(hoog) FROM g UNION ALL
            SELECT COUNT(hoog) FROM h UNION ALL
            SELECT COUNT(hoog) FROM i UNION ALL
            SELECT COUNT(hoog) FROM j UNION ALL
            SELECT COUNT(hoog) FROM k UNION ALL
            SELECT COUNT(hoog) FROM l UNION ALL
            SELECT COUNT(hoog) FROM m UNION ALL
            SELECT COUNT(hoog) FROM n UNION ALL
            SELECT COUNT(hoog) FROM o UNION ALL
            SELECT COUNT(hoog) FROM p UNION ALL
            SELECT COUNT(hoog) FROM q UNION ALL
            SELECT COUNT(hoog) FROM r UNION ALL
            SELECT COUNT(hoog) FROM s UNION ALL
            SELECT COUNT(hoog) FROM t UNION ALL
            SELECT COUNT(hoog) FROM u UNION ALL
            SELECT COUNT(hoog) FROM v UNION ALL
            SELECT COUNT(hoog) FROM w UNION ALL
            SELECT COUNT(hoog) FROM z)
        SELECT SUM(counts) FROM letterCounts
        ";

    $dbQueryVerbs = "
        WITH letterCounts AS
            (SELECT COUNT(hoog) AS counts FROM avb UNION ALL 
            SELECT COUNT(hoog) FROM bvb UNION ALL
            SELECT COUNT(hoog) FROM cvb UNION ALL
            SELECT COUNT(hoog) FROM dvb UNION ALL
            SELECT COUNT(hoog) FROM evb UNION ALL
            SELECT COUNT(hoog) FROM fvb UNION ALL
            SELECT COUNT(hoog) FROM gvb UNION ALL
            SELECT COUNT(hoog) FROM hvb UNION ALL
            SELECT COUNT(hoog) FROM ivb UNION ALL
            SELECT COUNT(hoog) FROM jvb UNION ALL
            SELECT COUNT(hoog) FROM kvb UNION ALL
            SELECT COUNT(hoog) FROM lvb UNION ALL
            SELECT COUNT(hoog) FROM mvb UNION ALL
            SELECT COUNT(hoog) FROM nvb UNION ALL
            SELECT COUNT(hoog) FROM ovb UNION ALL
            SELECT COUNT(hoog) FROM pvb UNION ALL
            SELECT COUNT(hoog) FROM qvb UNION ALL
            SELECT COUNT(hoog) FROM rvb UNION ALL
            SELECT COUNT(hoog) FROM svb UNION ALL
            SELECT COUNT(hoog) FROM tvb UNION ALL
            SELECT COUNT(hoog) FROM uvb UNION ALL
            SELECT COUNT(hoog) FROM vvb UNION ALL
            SELECT COUNT(hoog) FROM wvb UNION ALL
            SELECT COUNT(hoog) FROM z)
        SELECT SUM(counts) FROM letterCounts
        ";

    $dbHandle = new mysqli($dbConfig["servername"], $dbConfig["username"],
        $dbConfig["password"], $dbConfig["dbname"]);
    if ($dbHandle->connect_errno) {
        die("Verbendong geet ni: " . $dbHandle->connect_error);
    }


    $dbWordCount = (int) $dbHandle->query($dbQueryWords)->fetch_all(MYSQLI_NUM)[0][0];
    $dbVerbCount = (int) $dbHandle->query($dbQueryVerbs)->fetch_all(MYSQLI_NUM)[0][0];
    $dbHandle = null;
    $dbConfig = null;
}
wbGetCount();
