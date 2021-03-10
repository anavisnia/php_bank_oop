<?php

require __DIR__.'/bootstrap.php';

$uri = explode('/',str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));

_pc(str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));
_pc($uri);

echo "Pagrindinis";
