<?php

require '../bootloader.php';

$form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                    'validate_email'
                ]
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
        'password_second' => [
            'label' => 'Confirm password',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Register',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'validators' => [
        'validate_match' => [
            'password',
            'password_second'
        ]
    ]
];

function form_success($filtered_input, &$form) {
    $newUser = new App\Users\User($filtered_input);
    $modelUsers = new App\Users\Model();
    $modelUsers->insert($newUser);

    $form['fields']['password_second']['error'] = 'Registration successfull!';
}

function form_fail() {
    print 'fail';
}

$filtered_input = get_form_input($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
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