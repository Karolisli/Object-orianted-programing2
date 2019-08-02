<?php

declare(strict_types = 1);

require 'config.php';

// Load All Classes
require ROOT . '/vendor/autoload.php';

// Load Core Functions
require ROOT . '/core/functions/form/core.php';
require ROOT . '/core/functions/html/builder.php';

// Load App Functions
require ROOT . '/app/functions/form/validators.php';

$app = new App\App();

// Add Navigations
$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/drinks.php', 'title' => 'Nacnykas'],        
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout'],
    ]
];
