<?php declare(strict_types=1);

require("../wb/inc/wbAPI.php");

if (!isset($_GET["search"])) {
    echo "Error: No search string given. (search = empty)\n";
} else if (!isset($_GET["lang"]) || (!preg_match("/^plat$|^hoog$/i", $_GET["lang"]))) {
    echo "Error: Language preference not stated correctly. (lang = hoog|plat)\n";
} else if (!isset($_GET["return"]) || (!preg_match("/^html$|^xml$|^json$/i", $_GET["return"]))) {
    echo "Error: Result return type not stated correctly. (return = html|xml|json)\n";
} else {
    wbParseRequest($_GET["search"], $_GET["lang"], $_GET["return"]);    
}
?>