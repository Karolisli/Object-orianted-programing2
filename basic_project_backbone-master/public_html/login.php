<?php

require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home'],
        ['url' => 'register.php', 'title' => 'Regiser'],
        ['url' => 'login.php', 'title' => 'Login'],
    ]
];

$modelDrinks = new App\User\Model();

$thing = \App\App::$db->getData();
var_dump($thing);

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
                    'validate_email'
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
        ],
        'delete' => [
            'title' => 'Delete',
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
];

$filtered_input = get_form_input($form);

function form_success($filtered_input, &$form, $modelDrinks) {
    $_SESSION = $filtered_input;
}

function form_fail() {
    print 'fail';
}

function validate_email($filtered_input, &$field){
    $modelUser = new App\User\Model();
    $users = $modelUser->get (['email' => $filtered_input]);
    if($users){
        return false;
    }
    $field['error'] = 'Incorrect';
    return true;
}

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
        <?php foreach($drinks as $drink): ?>
        <div class='box'>
            <h3><?php print 'Welcome:'.' '. $drink->getName(); ?></h3>
        </div>    
        <?php endforeach; ?>
    </body>
</html>