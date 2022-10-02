<?php

$db_params = (require __DIR__ . "/params.php")['db'];

return [
    'class' => 'yii\db\Connection',
    'dsn' => $db_params['dsn'],
    'username' => $db_params['username'],
    'password' => $db_params['password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
