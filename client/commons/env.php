<?php

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL', 'http://localhost/base_du_an_1/');
//đường dẫn vào admin
define('BASE_URL_ADMIN', 'http://localhost/base_du_an_1/Admin/');
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'base_du_an_1');  // Tên database

define('PATH_ROOT', __DIR__ . '/../');