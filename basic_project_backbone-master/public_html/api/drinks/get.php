<?php

require '../../../bootloader.php';

// Tai yra objektas, galintis ištraukti iš
// duobmazės drink'ų (objektų) array'jų
$drinksModel = new \App\Drinks\Model();

// Šitus conditionus naudosim $drinksModel->get($conditions)
$conditions = [];

// Iš frontendo gali būti POST'intos conditions
// Jei taip yra, tai blet mes nustatotm savo $conditions array'jų
if ($_POST['conditions'] ?? false) {
    // Json decodinti reikia todėl, kad iš fronto pusės
    // ateina už json-encodintos kondicijos
    $conditions = json_decode($_POST['conditions'], true);
}

// Šio API'ajus pradinis responsas, kuris bus išsiųstas atgal į frontą
$response = [
    "status" => null,
    "data" => [],
];

// Užloadinam drink'sus pagal kondicijas (arba tuščia kondicijų array)
// jeigu iš fronto jis nebuvo nurodytas
$drinks = $drinksModel->get($conditions);
if ($drinks !== false) {
    foreach ($drinks as $drink_id => $drink) {
        // kadangi negalim json-encodinti Objekto drink
        // reikia iš jo gauti informaciją array'jaus pavidalu
        // ir įdėti į response['data']
        $response['data'][] = $drink->getData();
    }
    
    // Kadangi $drinks nebuvo hujovas, mes response statusą
    // nustatome į success
    $response['status'] = 'success';
} else {
    // Jeigu $drinks buvo hujovas, tada responsas
    // irgi hujovas
    $response['status'] = 'fail';
}

// Galų gale išprintinam response'ą
// Jį encodinam todėl, kad frontas suprastų
// kas per hujnia. (Frontas gali json-decodindamas
// pasiversti informaciją į javascriptinį array'jų (objektą)
print json_encode($response);