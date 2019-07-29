<?php

namespace App;

class Test {
    public static $db = 0;

    public $prop;

    public function __construct(){
        self::$db++;

        var_dump(self::$db);
    }
}

// $app = new App();

$test = new Test();

var_dump(Test::$db);

// var_dump($app->prop);

// var_dump(App::$db);

?>