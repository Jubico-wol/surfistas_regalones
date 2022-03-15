<?php


// define('DB_HOSTNAME','localhost'); // database host name
// define('DB_USERNAME', 'surfistas'); // database user name
// define('DB_PASSWORD', 'surfistas2022!'); // database password
// define('DB_NAME', 'surfistas'); // database name 


// define('DB_HOSTNAME','localhost'); // database host name
// define('DB_USERNAME', 'root'); // database user name
// define('DB_PASSWORD', ''); // database password
// define('DB_NAME', 'surfistas'); // database name 

define('DB_HOSTNAME','wordpress.ctoj0d7vtn5z.us-east-1.rds.amazonaws.com'); // database host name
define('DB_USERNAME', 'surfistas'); // database user name
define('DB_PASSWORD', 'surfistas2022!'); // database password
define('DB_NAME', 'verano'); // database name 

function generateRandomString($length = 32){
    $characters = '0123456789abcdefABCDEF';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>