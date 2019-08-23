<?php
require '../bootloader.php';

function get_form() {
    return [
        'attr' => [
            //'action' => '', Neb?tina, jeigu action yra ''
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
        'amount_ml' => [
            'label' => 'Amount ml',
            'type' => 'number',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'abarot' => [
            'label' => 'Abarot',
            'type' => 'number',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
        'image' => [
            'label' => 'Image',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ], 
    ],
        'callbacks' => [
            'success' => 'form_success',
            'fail' => 'form_fail'
        ],
        'validators' => [
        ]
    ];
}

function get_options() {
    $drinksModel = new App\Drinks\Model();
    $drinks = $drinksModel->get();
    $options = [];

    foreach ($drinks as $drink_id => $drink) {

        $options[$drink->getId()] = $drink->getName();
    }
    return $options;
}

function form_success($filtered_input, &$form) {

    $drink_id = $filtered_input['gerimas'];

    $modelDrinks = new App\Drinks\Model();
    $drinks = $modelDrinks->get(['row_id' => $drink_id]);

    /** @var \App\Drinks\Drink Description * */
    $drink = $drinks[0];
    $drink->drink();

    if ($drink->getAmount() > 0) {
        $modelDrinks->update($drink);
    } else {
        $modelDrinks->delete($drink);
        $form['fields']['gerimas']['options'] = get_options();
    }
}

function form_fail() {
    print 'fail';
}

$form = get_form();
$filtered_input = get_form_input($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
}

$modelDrinks = new App\Drinks\Model();
$drinks = $modelDrinks->get();

$newRegisterObject = new Core\View($form);
$newNavRegisterObject = new Core\View($nav);
       
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
        <?php print $newNavRegisterObject->render(ROOT . '/app/templates/navigation.tpl.php'); ?>

        <div class="content">
            <h1 class="vakaro-meniu">Vakaro MENIU</h1>
            
            <?php print $newRegisterObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?> 

            <div class="gerimai">  
                <?php foreach ($drinks as $drink): ?>
                    <div class="gerimas">
                        <?php if($_SESSION): ?>
                            <button class="updateButton" data-id="<?php print $drink->getId(); ?>">Update</button>
                        <?php endif; ?>
                        <h1><?php print $drink->getName(); ?></h1>
                        <h1><?php print $drink->getAmount(); ?>ml</h1>
                        <h1><?php print $drink->getAbarot(); ?>%</h1>
                        <img src="<?php print $drink->getImage(); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <script>
        document.getElementById("drinks-form").style.display = 'none';

        const buttonUpdate = document.querySelectorAll(".updateButton");
        const updateUrl = "api/drinks/update.php";

        buttonUpdate.forEach(function (selectedButton) {
            //                       console.log(selectedButton.getAttribute("data-id")); 
            selectedButton.addEventListener("click", e => {
                e.preventDefault();
                
                document.getElementById("drinks-form").style.display = 'block';
                
                const drinkId = e.target.getAttribute('data-id');
                const updatedName = document.querySelector("input[name='name']").value;
                const updatedAmount = document.querySelector("input[name='amount_ml']").value;
                const updatedAbarot = document.querySelector("input[name='abarot']").value;
                const updatedLink = document.querySelector("input[name='image']").value;

               const conditions = {
                    id: drinkId,
                    name: updatedName,
                    amount_ml: updatedAmount,
                    abarot: updatedAbarot,
                    image: updatedLink
                };

                 const jsonCond = JSON.stringify(conditions);

                // Dabar jau jsonCond yra stringas, todėl galima
                // appendinti į formData
                let formData = new FormData();
                formData.append('conditions', jsonCond);

                fetch(updateUrl, {
                    method: "POST",
                    body: formData
                })
                        .then(response => response.json())
                        .then(obj => {
                            if (obj.status == 'success') {
//                                        console.log(obj.data.name);
                        updatedName = obj.data.name;
                        updatedAmount = obj.data.amount;
                        updatedAbarot = obj.data.abarot;
                        updatedLink = obj.data.link;
                            } else {
                                console.log("nepavyko");
                            }
                            console.log(obj);
                        })
                        .catch(e => console.log(e.message));
            });
        });
    </script>
    </body>
</html>