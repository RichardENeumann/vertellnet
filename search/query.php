<?php
require("../logic/wbAPI.php");

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