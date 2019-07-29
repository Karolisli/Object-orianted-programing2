<?php

namespace App\User;

use \App\App;

class Model {

    private $name = 'user';

    public function __construct() {
        App::$db->createTable($this->name);
    }

    public function insert(User $user) {
        return App::$db->insertRow($this->name, $user->getData());
    }

    public function get($conditions = []) {
        $drinks = [];
        $rows = App::$db->getRowsWhere($this->name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
            $drinks[] = new User($row_data);
        }
        return $drinks;
    }

    public function update(User $user) {
        App::$db->updateRow($this->name, $user->getId(), $user->getData());
    }

    public function delete(User $user) {
        App::$db->deleteRow($this->name, $user->getId());
    }

    public function __destruct() {
        App::$db->save();
    }

}

?>