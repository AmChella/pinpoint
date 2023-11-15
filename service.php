<?php
require_once  __DIR__ . "/vendor/autoload.php";

use Amchella\Pinpoint\App;

try {
    $app = new App();
    $app->mail($_REQUEST);
    echo "Invite Successfully Sent!!</br>";
    echo "<a href='\'>Home</a>";
}
catch(Exception $e) {
    echo "Error: ", $e->getMessage();
    echo "</br><a href='\'>Home</a>";
}

