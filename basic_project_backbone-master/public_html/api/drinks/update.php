<?php 

require '../../../bootloader.php';

if($_SESSION){
    $drinksModel = new App\Drinks\Model();

    $conditions_object_decoded = json_decode($_POST['conditions'], true);

    $drink_id = $conditions_object_decoded['id'];

    $drinks = $drinksModel->get(['row_id' => intval($drink_id)]);

    $drink = $drinks[0];
    
    if (!$drinks) {
        print json_encode([
            'status' => 'fail',
            'errors' => [
                'Drink doesn`t exist'
            ]
        ]);
    } else {
        $drink->setName($conditions_object_decoded['name']);
        $drink->setAmount($conditions_object_decoded['amount_ml']);
        $drink->setAbarot($conditions_object_decoded['abarot']);
        $drink->setImage($conditions_object_decoded['image']);

        $drinksModel->update($drink);
        print json_encode([
            'status' => 'success',
            'errors' => [],
            'data' => $drink->getData()
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