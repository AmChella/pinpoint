<?php
require_once  __DIR__ . "/vendor/autoload.php";

use Amchella\Pinpoint\App;

try {
    $app = new App();
    print_r($app->repeatMail($_REQUEST));
    echo "</br>Invite Successfully Sent!!</br>";
    echo "<a href='\'>Home</a>";
}
catch(Exception $e) {
    echo "Error: ", $e->getMessage();
    echo "</br><a href='\'>Home</a>";
}

