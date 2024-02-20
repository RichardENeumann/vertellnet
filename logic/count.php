<?php
function wbGetCount() {
    $dbConfig = parse_ini_file(__DIR__."/../../private/config.ini");

    $dbQueryWords = "
        SELECT COUNT(hoog) FROM a UNION ALL
        SELECT COUNT(hoog) FROM b
        ";

    $dbQueryVerbs = "";

    $dbHandle = new mysqli($dbConfig["servername"], $dbConfig["username"],
        $dbConfig["password"], $dbConfig["dbname"]);
    if ($dbHandle->connect_errno) {
        die("Verbendong geet ni: " . $dbHandle->connect_error);
    }
    $dbWordCount = $dbHandle->query($dbQueryWords);
//    $dbVerbCount = $dbHandle->query($dbQueryVerbs);
    $dbHandle = null;
    $dbConfig = null;
//    var_dump($dbVerbCount->fetch_all(MYSQLI_ASSOC));
    var_dump($dbWordCount->fetch_all(MYSQLI_ASSOC));
}

wbGetCount();