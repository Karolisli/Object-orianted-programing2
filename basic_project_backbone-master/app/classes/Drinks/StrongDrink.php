<?php
namespace App\Drinks;

class StrongDrink extends Drink{
    public function drink(){
        // using parent
        parent::setAmount(parent::getAmount() - 50);
        // using $this->
        parent::setAmount($this->getAmount() - 50);

    }
    public function getImage(){
        if(parent::getImage()){ 
            return parent::getImage();
        }else{
            return 'https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn4.masterofmalt.com%2Fwhiskies%2Fp-2813%2Fjack-daniels-tennessee-whiskey.jpg%3Fss%3D2.0&f=1';
        }
    }
}

?>