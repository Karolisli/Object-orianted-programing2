<?php 

namespace App\Drinks;

use \App\App;

class Model{
    // private $db;
    private $table_name = 'drinks';
    private $drink;

    public function __construct(){
        App::$db->createTable($this->table_name);
    }

    public function insert(Drink $drink){
        return App::$db->insertRow($this->table_name, $drink->getData());
    }

    public function get($conditions = []){
        $drinks = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach($rows as $row_id => $row_data){
            $row_data['id'] = $row_id;
            $drinks[] = new Drink($row_data);
        }
        return $drinks;
    }

    public function update(Drink $drink){
        App::$db->updateRow($this->table_name, $drink->getId(), $drink->getData());
    }

    public function delete(Drink $drink){
        App::$db->deleteRow($this->table_name, $drink->getId());
    }

    public function __destruct(){
        App::$db->save();
    }
  
}

?>