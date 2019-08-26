<?php
require '../../../bootloader.php';

if ($_SESSION) {
    $drinksModel = new App\Drinks\Model();

    $drinks = $drinksModel->get(['row_id' => intval($_POST['id'])]);

    $drink = $drinks[0];

    if (!$drink) {
        print json_encode([
            'status' => 'fail',
            'errors' => [
                'Drink doesn`t exist'
            ]
        ]);
    } else {
        print json_encode([
            'status' => 'success',
            'errors' => [],
            'data' => $drink->getData()
        ]);
    }
}