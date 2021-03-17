<?php

require __DIR__.'/bootstrap.php';

$uri = explode('/',str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));

_pc(str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));
_pc($uri);

// echo "Pagrindinis";

// ROUTING

if ('' == $uri[0]) {
    (new App\UserController)->index();
}
elseif ('create' == $uri[0]) {
    (new App\UserController)->create();
}
elseif ('store' == $uri[0]) {
    (new App\UserController)->store();
}
elseif ('add' == $uri[0]) {
    (new App\Account)->add((int)$uri[1]);
}
elseif ('addAmount' == $uri[0]) {
    (new App\Account)->addAmount((int)$uri[1]);
}
elseif ('withdraw' == $uri[0]) {
    (new App\Account)->withdraw((int)$uri[1]);
}
elseif ('withdrawAmount' == $uri[0]) {
    (new App\Account)->withdrawAmount((int)$uri[1]);
}
elseif ('delete' == $uri[0]) {
    (new App\UserController)->delete((int)$uri[1]);
}