<?php

if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    // database config (local)
    define('DBNAME', 'servis_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    // konstanta za apsolutni put za datoteke (local)
    define('ROOT', 'http://localhost/PROJECTS/php-servis-mobitela/public');
} else {
    // database config (deployed)
    define('DBNAME', 'my_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    // konstanta za apsolutni put za datoteke (deployed)
    define('ROOT', 'https://www.tvojnekaawebstranica.com');
}

define('APP_NAME', "Agramservis");
define('APP_DESC', "Učinkovitost. Pouzdanost. Kvaliteta. Zadovoljstvo");