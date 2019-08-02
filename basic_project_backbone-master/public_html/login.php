<?php

require '../bootloader.php';

$form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                //validate float
                ]
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
//                    'validate_login'
                ]
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Login',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ],
        'delete' => [
            'title' => 'Log out',
            'extra' => [
                'attr' => [
                    'class' => 'blue-btn'
                ]
            ]
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'validators' => [
        'validate_login',
    ]
];

$filtered_input = get_form_input($form);

function form_success($filtered_input, &$form) {
    $_SESSION = $filtered_input;
    $form['fields']['password']['error'] = 'Login successfull!';
}

function form_fail() {
    print 'Login failed...';
}

$modelUsers = new App\Users\Model();

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
    case 'delete':
        foreach ($modelUsers->get() as $user) {
            $modelUsers->deleteAll();
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