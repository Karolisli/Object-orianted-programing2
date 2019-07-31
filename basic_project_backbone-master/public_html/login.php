<?php

require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home'],
        ['url' => 'register.php', 'title' => 'Register'],
        ['url' => 'login.php', 'title' => 'Login'],
        ['url' => 'logout.php', 'title' => 'Logout'],
        ['url' => 'drinks.php', 'title' => 'Drinks']
    ]
];

$modelDrinks = new App\User\Model();

$thing = \App\App::$db->getData();
// var_dump($thing);

$db = new \Core\FileDB(DB_FILE);

$drinks = $modelDrinks->get();

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'email',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                    // 'validate_login'
                ]
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Submit',
            'extra' => [
                'attr' => [
                    'class' => 'blue-btn'
                ]
            ]
        ]
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'validators' => [
        'validate_login'
    ]
];

$filtered_input = get_form_input($form);

session_start();

function form_success($filtered_input, &$form) {
    $_SESSION = $filtered_input;
    $form['fields']['email']['error'] = 'Welcome';
}
// var_dump($_SESSION);
function form_fail() {
    print 'Wrong, try again';
    // $form['fields']['email']['error'] = 'Wrong, try again';
}


function validate_login($filtered_input, &$form){
    $modelUser = new App\User\Model();
    $users = $modelUser->get ([
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ]);

    if(empty($users)){
        // $form['fields']['password']['error'] = 'Loggin failed!';
        return false;
    }

    return true;
}
// var_dump($filtered_input['password']);

// var_dump($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form, $modelDrinks);
        break;
    case 'delete':
        foreach ($modelDrinks->get() as $drink) {
            $modelDrinks->delete($drink);
        }
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OOP</title>
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">        
        <script defer src="media/js/app.js"></script>
    </head>
    <body>
        <?php require ROOT . '/app/templates/navigation.tpl.php'; ?>
        <div class="content">
            <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>
        </div>
    </body>
</html>
