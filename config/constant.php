<?php

// Define roles
if (!defined('ADMIN')) {
    define('ADMIN', 'admin');
}
if (!defined('USER')) {
    define('USER', 'user');
}
if (!defined('VENDOR')) {
    define('VENDOR', 'vendor');
}

return [
    'ADMIN' => 'admin',
    'USER' => 'user',
    'VENDOR' => 'vendor',
];