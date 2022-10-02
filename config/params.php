<?php

$local_variables = require __DIR__ . '/local_variables.php';

return array_merge([
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
], $local_variables);
