<?php 

namespace App\User;

class User{
    public $data = [];

    public function __construct($data = null) {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'id' => null,
                'name' => null,
                'email' => null,
                'password' => null,
            ];
        }
    }

    /**
     * Sets all data from array
     * @param array $array
     */
    public function setData($array) {
        if(isset($array['id'])){
            $this->setId($array['id']);
        }else{
            $this->data['id'] = null;
        }

        $this->setName($array['name'] ?? null);
        $this->setEmail($array['email'] ?? null);
        $this->setPassword($array['password'] ?? null);
    }

    /**
     * Gets all data as array
     * @return array
     */
    public function getData() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }

    /**
     * Sets name
     * @param string $name
     */
    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    /**
     * Returns name
     * @return string
     */
    public function getName() {
        return $this->data['name'];
    }
    /**
     * Sets password
     * @param string $password
     */
    public function setPassword(string $password){
        $this->data['password'] = $password;
    }
    /**
     * Returns password
     * @return password
     */
    public function getPassword(){
        return $this->data['password'];
    }

    /**
     * Sets email
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }

    /**
     * Returns email
     * @return string
     */
    public function getemail() {
        return $this->data['email'];
    }

    /**
     * @param id $id
     */
    public function setId(int $id){
        $this->data['id'] = $id;
    }
    /**
     * @return int|null
     */
    public function getId(){
        return $this->data['id'];
    }
}

?>