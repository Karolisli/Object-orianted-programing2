<?php

require '../bootloader.php';

$wiskey = new \App\Drinks\StrongDrink();
$wiskey->setAmount(700);
$wiskey->drink();

// var_dump('Wiskey'.' '.$wiskey->getAmount());

$beer = new \App\Drinks\LightDrink();
$beer->setAmount(1000);
$beer->drink();

// var_dump('Beer'.' '.$beer->getAmount());

// die();

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home'],
        ['url' => 'register.php', 'title' => 'Register'],
        ['url' => 'login.php', 'title' => 'Login'],
        ['url' => 'logout.php', 'title' => 'Logout'],
        ['url' => 'drinks.php', 'title' => 'Drinks']
    ]
];

$modelDrinks = new App\Drinks\Model();

$thing = \App\App::$db->getData();

$db = new \Core\FileDB(DB_FILE);

$drinks = $modelDrinks->get();

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'select' => [
            'label' => 'Atsigerti',
            'type' => 'select',
            'options' => drink_options(),
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Drink',
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
var_dump($drinks);

function drink_options (){
    $modelDrinks = new App\Drinks\Model();
    $drinks = $modelDrinks->get();
    $options = [];
    foreach ($drinks as $drink){
        $options[] = $drink->getName();
    }
    return $options;
}



function form_success($filtered_input, &$form, $modelDrinks) {
    $modelDrinks->insert(new App\Drinks\Drink($filtered_input));
}

function form_fail() {
    print 'fail';
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
            <div class='box_contents'>
                <h4><?php print $drink->getName(); ?></h4>
                <img src="<?php print $drink->getImage(); ?>">
                <p><?php print $drink->getAmount() .' '. 'ml'; ?></p>
            </div>    
        <?php endforeach; ?>
    </body>
</html>