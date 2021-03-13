<?php

require __DIR__.'/bootstrap.php';

$uri = explode('/',str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));

_pc(str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));
_pc($uri);

// echo "Pagrindinis";

// ROUTING

if ('' == $uri[0]) {
    (new UserController)->index();
}
elseif ('create' == $uri[0]) {
    (new UserController)->create();
}
elseif ('store' == $uri[0]) {
    (new UserController)->store();
}
elseif ('add' == $uri[0]) {
    (new UserController)->add((int)$uri[1]);
}
elseif ('withdraw' == $uri[0]) {
    (new UserController)->withdraw((int)$uri[1]);
}
elseif ('delete' == $uri[0]) {
    (new UserController)->delete((int)$uri[1]);
}