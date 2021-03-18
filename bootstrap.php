<?php
session_start();

define('URL', 'http://localhost/bit/bank_oop/'); // konstanta string pavidalu
define('DIR', __DIR__.'/'); // savo parasyta konstanta, kuri visada rodys kur mums reikia
define('INSTALL_DIR', '/bit/bank_oop/');
define('API', 'https://api.exchangeratesapi.io/latest?base=CAD');
define('TIME', 15); // cache laikas sekundem

// class autoload
require DIR.'vendor/autoload.php';
_pc($_SESSION, 'SESIJA--->');
?>