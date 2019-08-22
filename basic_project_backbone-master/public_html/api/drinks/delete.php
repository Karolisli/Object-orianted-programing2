<?php

require '../../../bootloader.php';

$drinksModel = new App\Drinks\Model();
$drinks = $drinksModel->get(['id' => intval($_POST['id'])]);
if($_SESSION){
   if (!$drinks) {
    print json_encode([
        'status' => 'fail',
        'errors' => [
            'Drink doesn`t exist'
        ]
    ]);
    } else {
        $drinksModel->delete($drinks[0]);
        print json_encode([
            'status' => 'success',
            'errors' => []
        ]);
    } 
} else {
    print json_encode([
        'status' => 'success',
        'errors' => [
            'You need to login'
        ]
    ]);
}
