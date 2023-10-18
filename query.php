<?php declare(strict_types=1);

require("inc/wbAPI.php");

// Database Query Parameters: 
// search(string) - if length=1 fetch by starting letter, else search whole wb in lang = hoog|plat for string
// lang(string) - hoog|plat - determines which way around to query the database
// return(string) - html|json|xml - returns result as html table, xml or json

if (!isset($_GET["search"])) {
    echo "Error: No search string given.\n";
} else if (!isset($_GET["lang"]) || (preg_match("/plat|hoog/i", $_GET["lang"]) == 0 | false)) {
    echo "Error: Language preference not stated correctly. (hoog|plat)\n";
} else if (!isset($_GET["return"]) || (preg_match("/html|xml|json/i", $_GET["return"]) == 0 | false)) {
    echo "Error: Result return type not stated correctly. (html|xml|json)\n";
} else {
    wbParseRequest($_GET["search"], $_GET["lang"], $_GET["return"]);    
}
?>