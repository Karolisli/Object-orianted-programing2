<?php 

require '../../../bootloader.php';

if($_SESSION){
    $drinksModel = new App\Drinks\Model();
    
    $drinks = $drinksModel->get(['row_id' => intval($_POST['id'])]);

    $drink = $drinks[0];
    
    if (!$drinks) {
        print json_encode([
            'status' => 'fail',
            'errors' => [
                'Drink doesn`t exist'
            ]
        ]);
    } else {
        $drink->setName($_POST['name']);
        $drink->setAmount($_POST['amount_ml']);
        $drink->setAbarot($_POST['abarot']);
        $drink->setImage($_POST['image']);

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