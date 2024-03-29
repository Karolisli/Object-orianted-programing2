<?php
require '../bootloader.php';

function insert_drinks() {
    $drinksModel = new App\Drinks\Model();

    $beer = new App\Drinks\Drink([
        'id' => null,
        'name' => '730',
        'amount_ml' => 500,
        'abarot' => 7.3,
        'image' => 'data:image/jpeg;base64,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'
    ]);

    $schnaps = new App\Drinks\Drink([
        'id' => null,
        'name' => 'Lithuania Auksine',
        'amount_ml' => 1000,
        'abarot' => 40,
        'image' => 'https://static.pricer.lt/dynamic/foreign.png?image=https%3A%2F%2Fwww.iki.lt%2Fassets%2FUploads%2FAlco%2F11609.jpg'
    ]);

    $drinksModel->insert($beer);
    $drinksModel->insert($schnaps);
}

function get_form() {
    return [
        'attr' => [
            //'action' => '', Neb?tina, jeigu action yra ''
            'id' => 'drinks-form',
            'method' => 'POST',
        ],
        'fields' => [
            'gerimas' => [
                'label' => 'Gerimas',
                'type' => 'select',
                'options' => get_options(),
            ],
        ],
        'buttons' => [
            'submit' => [
                'title' => 'Drink!',
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
        ]
    ];
}

$update_form = [
    'attr' => [
        //'action' => '', Neb?tina, jeigu action yra ''
        'method' => 'POST',
        'id' => 'update-form',
    ],
    'fields' => [
        'name' => [
            'label' => 'Drink',
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
    'buttons' => [
        'submit' => [
            'title' => 'Update',
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
    ]
];

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

$newUpdateObject = new Core\View($update_form);
$newRegisterObject = new Core\View($form);
$newNavRegisterObject = new Core\View($nav);

var_dump($_SESSION);
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
            
            <?php if ($_SESSION): ?>
                <?php print $newRegisterObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?> 
            <?php endif; ?>
            
            <div class="gerimai">  
                <?php foreach ($drinks as $drink): ?>
                    <div class="gerimas">
                        
                        <?php if ($_SESSION['email'] ?? false == "Admin@gmail.com"): ?>
                            <button class="deleteButton" data-id="<?php print $drink->getId(); ?>">Delete</button>
                            <button class="updateButton" data-id="<?php print $drink->getId(); ?>">Select</button>
                        <?php endif; ?>
                            
                        <h1 class="beername"><?php print $drink->getName(); ?></h1>
                        <h1 class="beeramount"><?php print $drink->getAmount(); ?>ml</h1>
                        <h1 class="beerabarot"><?php print $drink->getAbarot(); ?>%</h1>
                        <img src="<?php print $drink->getImage(); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close"><!--&times;--></span>
                    <?php print $newUpdateObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?> 
                </div>
            </div>
        </div>


        <script>
            'use strict';
            // Funkcija registruojanti form'os submit'o listenerį
            function addListener() {
                // Paselect'inam form'ą, kurios ID yra drinks-form
                document.getElementById("drinks-form")
                        // uždedam jai event'o listenerį, kuris suveiks ją submitinus
                        .addEventListener("submit", e => {
                            // default'inė event'o f-ija, kuri užkerta (preventina)
                            // puslapio perkrovimą submit'inus formą
                            e.preventDefault();
                            // Sukuriam default'ini objektą FormData
                            // Tai yra "tuščia dėžė", kurią nusiųsime
                            // duomenis POST metodu. Į ją append'inam duomenis
                            let formData = new FormData();
                            // Paduodame paspausto mygtuko duomenis
                            formData.append('action', 'submit');
                            // Kadangi tik po paspaudimo žinome, kokį gėrimą pasirinko
                            // useris, appendiname select'o su name "gerimas" value:
                            formData.append('gerimas', e.target.gerimas.value); // itraukiam gerimas:gerimo_id
                            // Fetch'as paima duomenis iš tam tikro URL'o
                            fetch("./drinks.php", {
                                // Prieš gaunant duomenis, mes galime juos išsiųsti
                                // tam tikru metodu. Šiuo atveju naudojame POST
                                method: "POST",
                                // Tai yra duomenys, kuriuos nusiunčiame į drinks.php
                                // Naudojame formData dėl to, kad PHP tinkamai atpažintų
                                // duomenis ir juos sudėtų į $_POST masyvą
                                body: formData
                            })
                                    // Gavus atsaką iš drinks.php, iškviečiama ši funkcija
                                    .then(response => {
                                        // Norėdami gauti tekstą (HTML) iš atsako,
                                        // naudojame šį kodą
                                        response.text().then(text => {
                                            console.log("done");
                                            // Kadangi atsako tekstas yra visas puslapio HTML
                                            // mes esamą HTML'ą perrašome su gautu (text)
                                            document.querySelector("html").innerHTML = text;
                                            // Kadangi perrašius HTML'ą nusimuša visi event'ų
                                            // listeneriai, reikia iš naujo užregistruoti
                                            addListener();
                                        });
                                    })
                                    .catch(e => {
                                        // Nes eik nx
                                        console.log(e);
                                    });
                        });
            }
            // Pirmo užkrovimo metu, registruojame listenerį formai
            addListener();


            const delUrl = "/api/drinks/delete.php";
            const delButton = document.querySelectorAll(".deleteButton");

            delButton.forEach(function (button) {
                button.addEventListener("click", e => {
                    let buttonEl = e.target;

                    const dataId = buttonEl.getAttribute('data-id');

                    let formData = new FormData();
                    formData.append('id', dataId);

                    fetch(delUrl, {
                        method: "POST",
                        body: formData
                    })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                buttonEl.parentNode.remove();
                            })
                            .catch(e => console.log(e.message));
                });
            });

            var modal = document.getElementById("myModal");

            var btn = document.querySelectorAll(".updateButton");
            btn.forEach(function (selected) {
                selected.onclick = function () {
                    modal.style.display = "block";
                };
            });
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            };
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };

            const buttonUpdate = document.querySelectorAll(".updateButton");
            const updateUrl = "api/drinks/update.php";
            const getById = "api/drinks/get_by_id.php";

            buttonUpdate.forEach(function (selectedButton) {
                selectedButton.addEventListener("click", e => {
                    e.preventDefault();

                    const drinkId = e.target.getAttribute('data-id');
                    let formValue = new FormData();
                    formValue.append('id', drinkId);
                    fetch(getById, {
                        method: "POST",
                        body: formValue
                    })
                            .then(response => {
                                response.json()
                                        .then(obj => {
                                            if (obj.status == 'success') {
                                                showUpdateForm(obj.data);
                                            } else {
                                                console.log("nepavyko buttonupdate");
                                            }
//                                            console.log(obj);
                                        })
                                        .catch(e => console.log(e.message));
                            });

                });
            });

            function showUpdateForm(data) {
                let updateForm = document.querySelector("#update-form");

                updateForm.name.value = data.name;
                updateForm.amount_ml.value = data.amount_ml;
                updateForm.abarot.value = data.abarot;
                updateForm.image.value = data.image;

                updateForm.addEventListener('submit', e => {
                    e.preventDefault();
                    let formData = new FormData(e.target);
                    formData.append('id', data.id);
                    fetch(updateUrl, {
                        method: "POST",
                        body: formData
                    })
                            .then(response => response.json())
                            .then(obj => {
                                if (obj.status == 'success') {
                                    updateDrinkInList(obj.data);
                                    modal.style.display = "none";
                                } else {
                                    console.log("nepavyko showUpdateForm");
                                }
                                console.log(obj);
                            })
                            .catch(e => console.log(e.message));
                });
            }

            function updateDrinkInList(data) {
                const updatingDrinkDiv = document.querySelector('*[data-id="' + data.id + '"]');
                const mainDiv = updatingDrinkDiv.parentNode;
                const drinkH1 = mainDiv.querySelector(".beername");
                drinkH1.innerHTML = data.name;
                const drinkH2 = mainDiv.querySelector(".beeramount");
                drinkH2.innerHTML = data.amount_ml + "ml";
                mainDiv.querySelector(".beerabarot").innerHTML = data.abarot + "%";
                mainDiv.querySelector("img").src = data.image;
            }

        </script>
    </body>
</html>