# quarrymanager-yii2backend
Front-end rep: https://github.com/UPSxACE/quarrymanager-reactfrontend

# How to setup the project and initialize it:
- Create a local_variables.php file in **config** folder (see example below)
- Run the query in **assets/mysqldump_final**
- Run ```composer install``` in the root folder
- Run ```php yii migrate``` in the root folder
- Initialize the server with ```php yii serve <IP> --port=80```

# Example of local_variables.php
```
<?php

return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=gestorpedreira',
        'username' => 'root',
        'password' => ''
        ],
    'email' => [
        'from' => 'SOME_EMAIL@outlook.com',
        'transport' => [
            'encryption' => 'tls',
            'host' => 'smtp-mail.outlook.com',
            'port' => '587',
            'username' => 'SOME_EMAIL@outlook.com',
            'password' => 'SOME_EMAIL_PASSWORD',
        ],
    ],
];
```
