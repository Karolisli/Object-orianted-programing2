<?php

namespace App;

class App {
    public static $db;

    public function __construct() {
        self::$db = new \Core\FileDB(DB_FILE);
        self::$db->load();
    }
    public function __destruct() {
        self::$db->save();
    }
}