<?php
require '../bootloader.php';


$update_form = [
    'attr' => [
        //'action' => '', Neb?tina, jeigu action yra ''
        'method' => 'POST',
        'id' => 'drinks-form',
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

$form = $update_form;

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
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close"><!--&times;--></span>
                    <?php print $newRegisterObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?> 
                </div>
            </div>

            <div class="gerimai">  
                <?php foreach ($drinks as $drink): ?>
                    <div class="gerimas">
                        <?php if ($_SESSION): ?>
                            <button class="updateButton" data-id="<?php print $drink->getId(); ?>">Select</button>
                        <?php endif; ?>
                        <h1 class="beername"><?php print $drink->getName(); ?></h1>
                        <h1 class="beeramount"><?php print $drink->getAmount(); ?>ml</h1>
                        <h1 class="beerabarot"><?php print $drink->getAbarot(); ?>%</h1>
                        <img src="<?php print $drink->getImage(); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>

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
            //        document.getElementById("drinks-form").style.display = 'none';

            const buttonUpdate = document.querySelectorAll(".updateButton");
            const updateUrl = "api/drinks/update.php";
            const getById = "api/drinks/get_by_id.php";

            buttonUpdate.forEach(function (selectedButton) {
                selectedButton.addEventListener("click", e => {
                    e.preventDefault();
                    //                document.getElementById("drinks-form").style.display = 'block';

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
//                                                console.log(obj.data);
                                                showUpdateForm(obj.data);
                                            } else {
                                                console.log("nepavyko buttonupdate");
                                            }
                                            console.log(obj);
                                        });
                                //                .catch(e => console.log(e.message));
                            });

                });
            });
            
            function showUpdateForm(data) {
//                console.log(data.name);
                let updateForm = document.querySelector("#drinks-form");
//                console.log(updateForm);
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
//                            .catch(e => console.log(e.message));
                });
            }

            function updateDrinkInList(data) {

                const updatingDrinkDiv = document.querySelector('*[data-id="' + data.id + '"]');
//                console.log(updatingDrinkDiv);
                const mainDiv = updatingDrinkDiv.parentNode;
                const drinkH1 = mainDiv.querySelector(".beername");
                drinkH1.innerHTML = data.name;
                const drinkH2 = mainDiv.querySelector(".beeramount");
                drinkH2.innerHTML = data.amount_ml;
                mainDiv.querySelector(".beerabarot").innerHTML = data.abarot+"%";
                mainDiv.querySelector("img").src = data.image;
            }
        </script>
    </body>
</html>