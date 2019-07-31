<?php
namespace App\Drinks;

class LightDrink extends Drink{
    public function drink(){
        parent::setAmount(parent::getAmount() - 100);
        
    }
    public function getImage(){
        if(parent::getImage()){
            return parent::getImage();
        }else{
            return 'https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fclipart-library.com%2Fimages%2F8cGbRrnki.gif&f=1';
        }
    }  
}

?>