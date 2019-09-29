<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host=localhost;dbname=casexe';
$db['username'] = 'postgres';
$db['password'] = '123';
$db['charset'] = 'utf8';

return $db;
