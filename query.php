<?php declare(strict_types=1);

require("inc/wbAPI.php");

if (!isset($_GET["search"])) {
    echo "Error: No search string given.\n";
} else if (!isset($_GET["lang"]) || (!preg_match("/^plat$|^hoog$/i", $_GET["lang"]))) {
    echo "Error: Language preference not stated correctly. (hoog|plat)\n";
} else if (!isset($_GET["return"]) || (!preg_match("/^html$|^xml$|^json$/i", $_GET["return"]))) {
    echo "Error: Result return type not stated correctly. (html|xml|json)\n";
} else {
    wbParseRequest($_GET["search"], $_GET["lang"], $_GET["return"]);    
}
?>