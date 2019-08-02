<?php

namespace App\Users;

//use \App\App; (naudojant šį use, užtektų parašyti App:: žemiau, nereikėtų viso kelio nurodyti

class Model {

    private $table_name = 'users';

    public function __construct() {
        \App\App::$db->createTable($this->table_name);
    }

    public function insert(User $user) {
        return \App\App::$db->insertRow($this->table_name, $user->getData());
    }

    public function get($conditions = []) {
        $users = [];
        $rows = \App\App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row) {
            $row['id'] = $row_id;
            $users[] = new User($row);
        }
        return $users;
    }

    public function update(User $user) {
        return \App\App::$db->updateRow($this->table_name, $user->getId(), $user->getData());
    }

    public function delete(User $user) {
        \App\App::$db->deleteRow($this->table_name, $user->getId());
    }

    public function deleteAll() {
        \App\App::$db->truncateTable($this->table_name);
    }

    public function __destruct() {
        \App\App::$db->save();
    }

}

?>
