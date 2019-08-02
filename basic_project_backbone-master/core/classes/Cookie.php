<?php

namespace Core;

class Cookie extends Abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        setcookie($this->name, null, -1, "/");
    }

    public function exists(): bool {
        if (isset($_COOKIE[$this->name])) {
            return true;
        } else {
            return false;
        }
    }

    public function read(): array {
        if ($this->exists()) {
            $array = json_decode($_COOKIE[$this->name], true);
            if (is_array($array)) {
                return $array;
            }
            
            trigger_error('That is not an array', E_USER_WARNING);
        }
        
        return [];
    }

    public function save($data, $expires_in = 3600): void {
        $string = json_encode($data);

        setcookie($this->name, $string, time() + $expires_in, "/");
    }

}
