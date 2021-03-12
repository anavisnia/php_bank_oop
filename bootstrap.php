<?php
session_start();

define('URL', 'http://localhost/bit/bank_oop/'); // konstanta string pavidalu
define('DIR', __DIR__.'/'); // savo parasyta konstanta, kuri visada rodys kur mums reikia
define('INSTALL_DIR', '/bit/bank_oop/');

// oop class links here
require DIR.'app/UserController.php';
require DIR.'app/Json.php';
require DIR.'app/User.php';
_pc($_SESSION, 'SESIJA--->');
?>